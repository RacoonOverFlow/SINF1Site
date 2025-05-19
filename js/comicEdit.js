function renderComicDetails(data) {
    const container = document.getElementById('comic-details');
    container.innerHTML = `
        <h1>${data.name}</h1>
        <p>Category: <span id="category-value">${data.category}</span></p>
        <p>Brand: <span id="brand-value">${data.brand}</span></p>
        <p>Editorial: <span id="editorial-value">${data.editorial}</span></p>
        <p>Year: <span id="year-value">${data.year}</span></p>
        <p>Description: <span id="description-value">${data.description}</span></p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background-color: red; color: white;">Delete</button>
    `;
    document.querySelector('.box_container_primary img').src = data.img_path;

    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteComic(data.id));
}

function startEdit(data) {
    const container = document.getElementById('comic-details');
    const id = container.dataset.comicId;

    container.innerHTML = `
        <p>Name: <input id="name-input" value="${data.name}" /></p>
        <p>Category: <input id="category-input" value="${data.category}" /></p>
        <p>Brand: <input id="brand-input" value="${data.brand}" /></p>
        <p>Editorial: <input id="editorial-input" value="${data.editorial}" /></p>
        <p>Year: <input id="year-input" value="${data.year}" /></p>
        <p>Description: <textarea id="description-input">${data.description}</textarea></p>
        <p>Image URL: <textarea id="img-input">${data.img_path}</textarea></p>
        <button id="save-btn">Save</button>
        <button id="cancel-btn">Cancel</button>
    `;

    document.getElementById('save-btn').onclick = function () {
        const newData = {
            id: parseInt(id),
            name: document.getElementById('name-input').value,
            category: document.getElementById('category-input').value,
            brand: document.getElementById('brand-input').value,
            editorial: document.getElementById('editorial-input').value,
            year: document.getElementById('year-input').value,
            description: document.getElementById('description-input').value,
            img_path: document.getElementById('img-input').value
        };

        fetch('../updateInfo/updateComic.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newData)
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    renderComicDetails(newData);
                } else {
                    alert('Update failed');
                }
            })
            .catch(() => alert('Request error'));
    };

    document.getElementById('cancel-btn').onclick = function () {
        renderComicDetails(data);
    };
}

function deleteComic(id) {
    if (!confirm('Are you sure you want to delete this comic?')) return;

    fetch('../updateInfo/updateComic.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, delete: true })
    })
        .then(res => res.json())
        .then(res => {
            if (res.deleted) {
                alert('Comic deleted');
                window.location.href = '../pages/comics.php';
            } else {
                alert('Delete failed');
            }
        })
        .catch(() => alert('Delete request failed'));
}

document.addEventListener('DOMContentLoaded', () => {
    const details = document.getElementById('comic-details');
    const data = {
        id: parseInt(details.dataset.comicId),
        name: document.querySelector('h1')?.textContent || '',
        category: document.getElementById('category-value').textContent,
        brand: document.getElementById('brand-value').textContent,
        editorial: document.getElementById('editorial-value').textContent,
        year: document.getElementById('year-value').textContent,
        description: document.getElementById('description-value').textContent,
        img_path: document.querySelector('.box_container_primary img').src
    };
    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteComic(data.id));
});
