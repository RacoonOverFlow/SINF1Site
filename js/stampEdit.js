function renderStampDetails(data) {
    const container = document.getElementById('stamp-details');
    container.innerHTML = `
        <h1>${data.name}</h1>
        <p>Category: <span id="category-value">${data.category}</span></p>
        <p>Description: <span id="description-value">${data.description}</span></p>
        <p>Country: ${data.country}</p>
        <p>City: ${data.city}</p>
        <p>Year: ${data.year}</p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background-color: red; color: white;">Delete</button>
    `;
    document.querySelector('.box_container_primary img').src = data.img_path;

    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteStamp(data.id));
}


function startEdit(data) {
    const container = document.getElementById('stamp-details');
    const id = container.dataset.stampId;

    container.innerHTML = `
        <p>Name: <input id="name-input" value="${data.name}" /></p>
        <p>Description: <textarea id="description-input">${data.description}</textarea></p>
        <p>Image URL: <input id="img-input" value="${data.img_path}" /></p>
        <p>Country: <input id="country-input" value="${data.country || ''}" /></p>
        <p>City: <input id="city-input" value="${data.city || ''}" /></p>
        <p>Year: <input id="year-input" value="${data.year || ''}" /></p>
        <p>Category: <input id="category-input" value="${data.category}" /></p>
        <button id="save-btn">Save</button>
        <button id="cancel-btn">Cancel</button>
    `;

    document.getElementById('save-btn').onclick = function () {
        const newData = {
            id: parseInt(id),
            name: document.getElementById('name-input').value,
            description: document.getElementById('description-input').value,
            img_path: document.getElementById('img-input').value,
            country: document.getElementById('country-input').value,
            city: document.getElementById('city-input').value,
            year: document.getElementById('year-input').value,
            category: document.getElementById('category-input').value
        };

        fetch('../updateInfo/updateStamp.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newData)
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    window.location.href = '../pages/stamps.php';
                } else {
                    alert('Update failed');
                }
            })
            .catch(() => alert('Request error'));
    };

    document.getElementById('cancel-btn').onclick = function () {
        renderStampDetails(data);
    };
}


function deleteStamp(id) {
    if (!confirm('Are you sure you want to delete this stamp?')) return;

    fetch('../updateInfo/updateStamp.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, action: 'delete' })
    })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert('Stamp deleted');
                window.location.href = '../pages/stamps.php';
            } else {
                alert('Delete failed');
            }
        })
        .catch(() => alert('Delete request failed'));
}

document.addEventListener('DOMContentLoaded', () => {
    const details = document.getElementById('stamp-details');
    const data = {
        id: parseInt(details.dataset.stampId),
        name: document.querySelector('h1')?.textContent || '',
        category: document.getElementById('category-value').textContent,
        description: document.getElementById('description-value').textContent,
        img_path: document.querySelector('.box_container_primary img').src
    };
    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteStamp(data.id));
});
