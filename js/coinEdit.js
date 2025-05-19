function renderCoinDetails(data) {
    const container = document.getElementById('coin-details');
    container.innerHTML = `
    <h1>${data.coin_name}</h1>
    <p>Category: <span id="category-value">${data.category}</span></p>
    <p>Country: <span id="country-value">${data.country}</span></p>
    <p>Denomination: <span id="denomination-value">${data.denomination}</span></p>
    <p>Quantity: <span id="quantity-value">${data.quantity}</span></p>
    <p>Description: <span id="description-value">${data.description}</span></p>
    <button id="edit-btn">Edit</button>
    <button id="delete-btn" style="background-color: red; color: white;">Delete</button>
  `;
    document.querySelector('.box_container_primary img').src = data.img_path;

    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteCoin(data.id));
}

function startEdit(data) {
    const container = document.getElementById('coin-details');
    const id = container.dataset.coinId;

    container.innerHTML = `
    <p>Name: <input id="name-input" value="${data.coin_name}" /></p>
    <p>Category: <input id="category-input" value="${data.category}" /></p>
    <p>Country: <input id="country-input" value="${data.country}" /></p>
    <p>Denomination: <input id="denomination-input" value="${data.denomination}" /></p>
    <p>Quantity: <input id="quantity-input" type="number" value="${data.quantity}" /></p>
    <p>Description: <textarea id="description-input">${data.description}</textarea></p>
    <p>Image URL: <textarea id="img-input">${data.img_path}</textarea></p>
    <button id="save-btn">Save</button>
    <button id="cancel-btn">Cancel</button>
  `;

    document.getElementById('save-btn').onclick = function () {
        const newData = {
            id: parseInt(id),
            coin_name: document.getElementById('name-input').value,
            category: document.getElementById('category-input').value,
            country: document.getElementById('country-input').value,
            denomination: document.getElementById('denomination-input').value,
            quantity: parseInt(document.getElementById('quantity-input').value),
            description: document.getElementById('description-input').value,
            img_path: document.getElementById('img-input').value
        };

        fetch('../updateInfo/updateCoin.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newData)
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    renderCoinDetails(newData);
                } else {
                    alert('Update failed');
                }
            })
            .catch(() => alert('Request error'));
    };

    document.getElementById('cancel-btn').onclick = function () {
        renderCoinDetails(data);
    };
}

function deleteCoin(id) {
    if (!confirm('Are you sure you want to delete this coin?')) return;

    fetch('../updateInfo/updateCoin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, delete: true })
    })
        .then(res => res.json())
        .then(res => {
            if (res.deleted) {
                alert('Coin deleted');
                window.location.href = '../pages/coins.php';
            } else {
                alert('Delete failed');
            }
        })
        .catch(() => alert('Delete request failed'));
}

document.addEventListener('DOMContentLoaded', () => {
    const details = document.getElementById('coin-details');
    const data = {
        id: parseInt(details.dataset.coinId),
        coin_name: document.querySelector('h1')?.textContent || '',
        category: document.getElementById('category-value').textContent,
        country: document.getElementById('country-value').textContent,
        denomination: document.getElementById('denomination-value').textContent,
        quantity: parseInt(document.getElementById('quantity-value').textContent),
        description: document.getElementById('description-value').textContent,
        img_path: document.querySelector('.box_container_primary img').src
    };
    document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
    document.getElementById('delete-btn').addEventListener('click', () => deleteCoin(data.id));
});
