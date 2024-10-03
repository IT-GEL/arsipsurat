@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Feedback Aplikasi Arsip Surat</h6>
                <form id="feedbackForm" method="post" action="{{ url('/dashboard/mss') }}">
                    @csrf

                    <div id="feedback-field" class="mb-3">
                        <label for="feedback" class="form-label">Jika ada kekurangan dari aplikasi arsip surat ini atau ada bug, tolong isikan feedback</label>
                        <textarea id="feedback" name="feedback" class="form-control @error('feedback') is-invalid @enderror"></textarea>
                        @error('feedback')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="users-field" class="mb-3">
                        <label for="users" class="form-label">Nama : </label>
                        <input id="users" name="users" class="form-control @error('users') is-invalid @enderror" required>
                        @error('users')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hidden input for user's account -->
                    <input type="hidden" name="acc" value="{{ auth()->user()->name }}"> <!-- Adjust based on your actual user model -->

                    <button type="submit" class="btn btn-primary">Kirim Feedback</button>
                </form>
                <div id="errorMessages" class="mt-3"></div> <!-- Placeholder for error messages -->
            </div>
        </div>
    </div>
</div>

<style>
    .drag-over {
        border: 2px dashed #007bff;
        background: rgba(0, 123, 255, 0.1);
    }
</style>

<script>
    class DragAndDrop {
        constructor(jodit) {
            this.jodit = jodit;
            this.init();
        }

        init() {
            const editorArea = this.jodit.container;

            editorArea.addEventListener('dragover', (event) => {
                event.preventDefault();
                editorArea.classList.add('drag-over');
            });

            editorArea.addEventListener('dragleave', () => {
                editorArea.classList.remove('drag-over');
            });

            editorArea.addEventListener('drop', (event) => {
                event.preventDefault();
                editorArea.classList.remove('drag-over');

                const files = event.dataTransfer.files;
                if (files.length > 0) {
                    for (const file of files) {
                        if (file.type.startsWith('image/')) {
                            this.handleImageUpload(file);
                        }
                    }
                }
            });
        }

        handleImageUpload(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = `<img src="${e.target.result}" alt="Uploaded Image" style="max-width: 100%;" />`;
                this.jodit.selection.insertHTML(img);
            };
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const feedbackEditor = Jodit.make('#feedback', {
            uploader: {
                insertImageAsBase64URI: true,
                imagesExtensions: ['jpg', 'jpeg', 'png', 'gif']
            }
        });

        new DragAndDrop(feedbackEditor);

        document.getElementById('feedbackForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // This header indicates an AJAX request
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                Swal.fire({
                    icon: "success",
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                this.reset(); // Reset the form if needed
                document.getElementById('errorMessages').innerHTML = ''; // Clear error messages
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pengiriman feedback gagal, coba lagi nanti.',
                });
            });
        });

    });
</script>
@endsection
