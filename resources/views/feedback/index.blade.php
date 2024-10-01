@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Feedback Aplikasi Arsip Surat</h6>
                    <form method="post" action="/dashboard/it">
                        @csrf

                        <div id="feedback-field" class="mb-3">
                            <label for="feedback" class="form-label">Jika ada kekurangan dari aplikasi arsip surat ini atau ada bug, tolong isikan feedback</label>
                            <textarea id="feedback" name="feedback" class="form-control @error('feedback') is-invalid @enderror"></textarea>
                            <script>
                                class DragAndDrop {
                                    constructor(jodit) {
                                        this.jodit = jodit;
                                        this.init();
                                    }

                                    init() {
                                        const editorArea = this.jodit.container;

                                        // Add dragover and drop event listeners
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
                                    const feedbackEditor = Jodit.make('#feedback');
                                    new DragAndDrop(feedbackEditor);
                                });


                                document.getElementById('feedbackForm').addEventListener('submit', function(event) {
                                event.preventDefault(); // Prevent default form submission

                                // Submit the form via AJAX
                                const formData = new FormData(this);
                                fetch(this.action, {
                                    method: 'POST',
                                    body: formData,
                                })
                                .then(response => {
                                    if (response.ok) {
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "Your work has been saved",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        // Optionally, redirect or reset the form
                                        this.reset(); // Reset the form if needed
                                    } else {
                                        throw new Error('Form submission failed.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                            });
                            </script>
                        </div>

                        <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </form>
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
@endsection
