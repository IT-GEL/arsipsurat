document.addEventListener('DOMContentLoaded', function() {
    const documentContainer = document.getElementById('document');
    const pageHeight = 1000; // Height of A4 in mm

    function paginateContent() {
        const pages = Array.from(document.querySelectorAll('.page'));

        pages.forEach(page => {
            let content = page.querySelector('.content');
            let contentHeight = content.scrollHeight;

            while (contentHeight > pageHeight) {
                // Create a new page
                let newPage = document.createElement('div');
                newPage.className = 'page';

                // Clone the header for the new page
                let headerClone = document.querySelector('.header').cloneNode(true);
                newPage.appendChild(headerClone);

                let newContent = document.createElement('div');
                newContent.className = 'content';

                // Move overflowing content to the new page
                while (content.scrollHeight > pageHeight && content.lastChild) {
                    newContent.insertBefore(content.lastChild, newContent.firstChild);
                }

                // Append the new content to the new page
                newPage.appendChild(newContent);
                documentContainer.appendChild(newPage);

                // Recalculate content height for the current page
                contentHeight = content.scrollHeight;
            }
        });
    }

    paginateContent();
});


document.addEventListener('DOMContentLoaded', function() {
    const documentContainer = document.getElementById('document');
    const pageHeight = 1000; // Height of A4 in mm

    function paginateContent() {
        const pages = Array.from(document.querySelectorAll('.page'));
        const content = document.getElementById('content');
        const contentstyle = window.getComputedStyle(content);

        let divcontent = content.innerHTML;
        let divcontentHeight = content.scrollHeight;

        pages.forEach(page => {
            while (divcontentHeight > pageHeight) {
                // Create a new page
                let newPage = document.createElement('div');
                newPage.className = 'page';

                // Clone the header for the new page
                let headerClone = content.cloneNode(true);
                newPage.appendChild(headerClone);

                let newContent = document.createElement('div');
                newContent.className = 'content';
                newContent.style = contentstyle;

                // Move overflowing content to the new page
                while (content.scrollHeight > pageHeight && content.lastChild) {
                    newContent.insertBefore(content.lastChild, newContent.firstChild);
                }

                // Append the new content to the new page
                newPage.appendChild(newContent);
                documentContainer.appendChild(newPage);

                // Recalculate content height for the current page
                divcontentHeight = content.scrollHeight;
            }
        });
    }

    paginateContent();
});
