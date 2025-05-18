function formatDateEU(dateStr) {
  if (!dateStr) return '';
  if (/^\d{2}\/\d{2}\/\d{4}$/.test(dateStr)) return dateStr;
  const d = new Date(dateStr);
  if (isNaN(d.getTime())) return dateStr;
  const day = String(d.getDate()).padStart(2, '0');
  const month = String(d.getMonth() + 1).padStart(2, '0');
  const year = d.getFullYear();
  return `${day}/${month}/${year}`;
}

function renderDetails(data) {
  const details = document.getElementById('event-details');
  let catColor = '#ee8130';
  details.innerHTML = `
    <p>Category: <span id="category-value" style="color: ${catColor};">${data.category}</span></p>
    <p>Date: <span id="date-value" style="color: #94cfde;">${formatDateEU(data.date)}</span></p>
    <p>Location: <span id="location-value" style="color: #94cfde;">${data.location}</span></p>
    <p>Description: <span id="description-value" style="color: #94cfde;">${data.description}</span></p>
    <button id="edit-btn">Edit</button>
  `;

  document.querySelector('.box_container_primary img').setAttribute('src', data.img_path);
  document.getElementById('edit-btn').addEventListener('click', () => startEdit(data));
}

function startEdit(data) {
  const details = document.getElementById('event-details');
  const eventId = details.dataset.eventId;

  const catOptions = ['Trading', 'Meetup', 'Auction', 'Workshop', 'Showcase', 'Tournament', 'Guest talk', 'Appraisal', 'Other'];
  let catSelect = `<select id="category-input">`;
  catOptions.forEach(opt => {
    catSelect += `<option value="${opt}"${data.category === opt ? ' selected' : ''}>${opt}</option>`;
  });
  catSelect += `</select>`;

  // Convert date to YYYY-MM-DD for input
  let dateValue = data.date;
  if (/^\d{2}\/\d{2}\/\d{4}$/.test(dateValue)) {
    const [day, month, year] = dateValue.split('/');
    dateValue = `${year}-${month}-${day}`;
  }
  const dateObj = new Date(dateValue);
  if (!isNaN(dateObj.getTime())) {
    dateValue = dateObj.toISOString().slice(0, 10);
  }

  // Use img_path from data, fallback to current image if missing
  let imgPath = data.img_path || document.querySelector('.box_container_primary img').getAttribute('src');

    details.innerHTML = `
    <p>Category: ${catSelect}</p>
    <p>Date: <input id="date-input" type="date" value="${dateValue}" /></p>
    <p>Location: <input id="location-input" value="${data.location}" /></p>
    <p>Description: <textarea id="description-input">${data.description}</textarea></p>
    <p>Image: <textarea id="img-input" style="width:200%;min-height:2.5em;resize:vertical;font-size:0.4em;padding:0.7em;box-sizing:border-box;">${imgPath}</textarea></p>
    <button id="save-btn">Save</button>
    <button id="cancel-btn">Cancel</button>
    `;

document.getElementById('save-btn').onclick = function() {
    const dateInput = document.getElementById('date-input').value.trim();
    if (!dateInput) {
        alert('Date is required.');
        return;
    }
    const selectedDate = new Date(dateInput);
    const today = new Date();
    today.setHours(0,0,0,0); // Ignore time part

    if (selectedDate < today) {
        alert('Date cannot be in the past.');
        return;
    }

    const newData = {
      id: parseInt(eventId),
      category: document.getElementById('category-input').value,
      date: dateInput,
      place: document.getElementById('location-input').value,
      description: document.getElementById('description-input').value,
      title: document.getElementById('event_title').textContent,
      img_path: document.getElementById('img-input').value,
      user_id: details.dataset.userId || 1
    };

    fetch('../updateInfo/updateEvent.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(newData)
    })
    .then(res => res.json())
    .then(response => {
      if (response.success) {
        document.querySelector('.box_container_primary img').setAttribute('src', newData.img_path);
        renderDetails({
          ...newData,
          location: newData.place
        });
      } else {
        alert('Failed to update event.');
      }
    })
    .catch(() => alert('Failed to update event.'));
  };

  document.getElementById('cancel-btn').onclick = function() {
    renderDetails(data);
  };
}

document.addEventListener('DOMContentLoaded', function () {
  const details = document.getElementById('event-details');
  const initialData = {
    category: document.getElementById('category-value').textContent,
    date: document.getElementById('date-value').textContent,
    location: document.getElementById('location-value').textContent,
    description: document.getElementById('description-value').textContent,
    img_path: document.querySelector('.box_container_primary img').getAttribute('src')
  };
  document.getElementById('edit-btn').addEventListener('click', () => startEdit(initialData));
});