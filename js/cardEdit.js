function renderCardDetails(data) {
    const container = document.getElementById('card-details');
    container.innerHTML = `
        <h1>${data.name}</h1>
        <p>Category: <span id="category-value">${data.category}</span></p>
        <p>Description: <span id="description-value">${data.description}</span></p>
        <p>Edition: ${data.edition}</p>
        <p>Rareness: ${data.rareness}</p>
        <p>Condition: ${data.card_condition}</p>
        <button id="edit-btn">Edit</button>
        <button id="delete-btn" style="background:red;color:white;">Delete</button>
    `;
    document.querySelector('.box_container_primary img').src = data.img_path;

    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteCard(data.id));
}


function startEdit(data) {
    const container = document.getElementById('card-details');
    const id = container.dataset.cardId;

    container.innerHTML = `
        <p>Name: <input id="name-input" value="${data.name}" /></p>
        <p>Description: <textarea id="description-input">${data.description}</textarea></p>
        <p>Image URL: <input id="img-input" value="${data.img_path}" /></p>
        <p>Edition: <input id="edition-input" value="${data.edition || ''}" /></p>
        <p>Rareness: <input id="rareness-input" value="${data.rareness || ''}" /></p>
        <p>Condition: <input id="condition-input" value="${data.card_condition || ''}" /></p>
        <p>Category: <input id="category-input" value="${data.category}" /></p>
        <button id="save-btn">Save</button>
        <button id="cancel-btn">Cancel</button>
    `;

    document.getElementById('save-btn').onclick = function () {
        const newData = {
            id: parseInt(id),
            name: document.getElementById('name-input').value,
            category: document.getElementById('category-input').value,
            description: document.getElementById('description-input').value,
            img_path: document.getElementById('img-input').value,
            edition: document.getElementById('edition-input') ? document.getElementById('edition-input').value : "",
            rareness: document.getElementById('rareness-input') ? document.getElementById('rareness-input').value : "",
            card_condition: document.getElementById('condition-input') ? document.getElementById('condition-input').value : ""
        };

        fetch('../updateInfo/updateCard.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newData)
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    // Redirect to refreshed cards page
                    window.location.href = '../pages/cards.php';
                } else {
                    alert('Update failed');
                }
            })
            .catch(() => alert('Request error'));
    };
    document.getElementById('cancel-btn').onclick = function () {
        renderCardDetails(data);
    };
}


function deleteCard(id) {
    if (!confirm('Are you sure you want to delete this card?')) return;

    fetch('../updateInfo/updateCard.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, delete: true })
    })
        .then(res => res.json())
        .then(res => {
            if (res.deleted) {
                alert('Card deleted');
                window.location.href = '../pages/cards.php';
            } else {
                alert('Delete failed');
            }
        })
        .catch(() => alert('Delete request failed'));
}

document.addEventListener('DOMContentLoaded', () => {
    const details = document.getElementById('card-details');
    const data = {
        id: parseInt(details.dataset.cardId),
        name: document.querySelector('h1')?.textContent || '',
        category: document.getElementById('category-value').textContent,
        description: document.getElementById('description-value').textContent,
        img_path: document.querySelector('.box_container_primary img').src
    };
    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteCard(data.id));
});
