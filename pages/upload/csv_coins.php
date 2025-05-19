
<!DOCTYPE php>
<php lang="en">

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const categorySelect = document.getElementById('category-select');

      categorySelect.addEventListener('change', function () {
        const selectedCategory = this.value;
        window.location.href = window.location.pathname + '?category=' + encodeURIComponent(selectedCategory);
      });
    });

    function readCSVFile(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();

            reader.onload = function(event) {
                const text = event.target.result;
                const rows = parseCSV(text);
                if (rows.length < 2) {
                    resolve([]);
                    return;
                }

                const headers = rows[0].map(h => h.trim());
                const idIndex = headers.indexOf('id');

                const data = rows.slice(1).map(row => {
                    const obj = {};
                    headers.forEach((header, i) => {
                        if (header.toLowerCase() === 'id') return; // Ignore 'id'
                        obj[header] = (row[i] || '').trim();
                    });
                    return obj;
                });

                resolve(data);
            };

            reader.onerror = reject;
            reader.readAsText(file);
        });
    }
    function parseCSV(text) {
        const rows = [];
        let row = [], field = '', inQuotes = false;

        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const next = text[i + 1];

            if (inQuotes) {
                if (char === '"' && next === '"') {
                    field += '"';
                    i++; // skip second quote
                } else if (char === '"') {
                    inQuotes = false;
                } else {
                    field += char;
                }
            } else {
                if (char === '"') {
                    inQuotes = true;
                } else if (char === ',') {
                    row.push(field);
                    field = '';
                } else if (char === '\n') {
                    row.push(field);
                    rows.push(row);
                    row = [];
                    field = '';
                } else if (char === '\r' && next === '\n') {
                    // Handle Windows \r\n newlines
                    continue;
                } else {
                    field += char;
                }
            }
        }

        if (field !== '' || row.length > 0) {
            row.push(field);
            rows.push(row);
        }

        return rows;
    }
  </script>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coins</title>
    <link rel="stylesheet" href="../../css/coin.css" />
    <link rel="stylesheet" href="../../css/test.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Bangers&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    />
  </head>
  <body>
  <header>
      <div class="header-container">
          <div>
              <a href="../../index.php"><img class="logo" src="../../Images/Logo.png" alt="logo" /></a>
          </div>

          <form action="../../search.php" method="GET" class="nav-search">
              <select name="category" class="select-search" required>
                  <option value="" disabled selected>Select Category</option>
                  <option value="stamps">Stamps</option>
                  <option value="coins">Coins</option>
                  <option value="comics">Comics</option>
                  <option value="cards">Cards</option>
                  <option value="miniatures">Miniatures</option>
                  <option value="events">Events</option>
              </select>

              <input type="text" name="query" placeholder="Search" class="search-input" required />
              <button type="submit" class="search-icon">
                  <span class="material-symbols-outlined">search</span>
              </button>
          </form>

          <div class="users">
              <div class="user-icon">
                  <a href="../../userPages/login.php"><span class="material-symbols-outlined">person</span></a>
              </div>
              <div class="user-name">
                  <p>Username</p>
              </div>
              <div class="logout">
                  <button type="button" class="btn btn-default btn-sm">
                      <span class="glyphicon glyphicon-log-out"></span> Log out
                  </button>
              </div>
          </div>
      </div>
  </header>

  <nav class="dashboard">
      <ul>
          <li><a class="miniatures" href="../../pages/miniatures.php">Miniatures</a></li>
          <li class="divider">|</li>
          <li><a class="stamps" href="../../pages/stamps.php">Stamps</a></li>
          <li class="divider">|</li>
          <li><a class="coins" href="../../pages/coins.php">Coins</a></li>
          <li class="divider">|</li>
          <li><a class="comics" href="../../pages/comics.php">Comics</a></li>
          <li class="divider">|</li>
          <li><a class="cards" href="../../pages/cards.php">Cards</a></li>
          <li class="divider">|</li>
          <li><a class="events" href="../../pages/events.php">Events</a></li>
          <li class="divider">|</li>
          <li><a class="collections" href="../../pages/MyCollections.php">My Collections</a></li>
          <li class="divider">|</li>
          <li><a class="upload active" href="../../pages/upload/csv_coins.php">CSV Upload</a></li>
      </ul>
  </nav>

    <div class="more-categories" id="more-categories">
      <ul>
        <li><a href="category1.php">Category 1</a></li>
        <li><a href="category2.php">Category 2</a></li>
        <li><a href="category3.php">Category 3</a></li>
        <li><a href="category4.php">Category 4</a></li>
      </ul>
    </div>

    <div class="more-categories" id="more-categories">
      <ul>
        <li><a href="category1.php">Category 1</a></li>
        <li><a href="category2.php">Category 2</a></li>
        <li><a href="category3.php">Category 3</a></li>
        <li><a href="category4.php">Category 4</a></li>
      </ul>
    </div>
    <div style="margin-top: 20px; margin-left: 20px">
        <form id="csvForm" enctype="multipart/form-data" method="post" onsubmit="return handleUpload(event)">
            <div id="drop-area">
                <p>Coins Collection CSV reader<br>
                <br>
                <label for="fileElem" style="color:blue;cursor:pointer;">Browse</label>
                <input type="file" id="fileElem" name="csvfile" accept=".csv" onchange="handleFiles(this.files)">
                </p>
                <div id="fileLabel"></div>
            </div>
        <button type="submit" id="uploadBtn" disabled>Upload</button>
    </form>
    </div>

        <script>
            const dropArea = document.getElementById('drop-area');
            const fileElem = document.getElementById('fileElem');
            const fileLabel = document.getElementById('fileLabel');
            const uploadBtn = document.getElementById('uploadBtn');
            let selectedFile = null;

            ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false)
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ;['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.add('highlight'), false)
            });

            ;['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.remove('highlight'), false)
            });

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            function handleFiles(files) {
                if (files.length > 0 && files[0].type === "text/csv" || files[0].name.endsWith('.csv')) {
                    selectedFile = files[0];
                    fileLabel.textContent = selectedFile.name;
                    uploadBtn.disabled = false;
                } else {
                    fileLabel.textContent = "Please select a CSV file.";
                    uploadBtn.disabled = true;
                }
            }

            function handleUpload(event) {
                event.preventDefault();
                readCSVFile(selectedFile)
                    .then(csvArray => {
                        window.csvArray = csvArray; // Store globally if needed
                        for (let i = 0; i < csvArray.length; i++) {
                            fetch('./handlers/csv_upload_coins.php', {
                                method: 'POST',
                                headers: {
                                'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(csvArray[i])
                            })
                            .then(res => res.json())
                            .then(result => {
                                if (result.success) {
                                responseMsg.textContent = result.message;
                                responseMsg.style.color = 'green';
                                form.reset();
                                } else {
                                responseMsg.textContent = result.error || "An error occurred.";
                                responseMsg.style.color = 'red';
                                }

                            })
                            .catch(error => {
                                responseMsg.textContent = "Fetch error: " + error;
                                responseMsg.style.color = 'red';
                            });
                        }
                        alert('CSV loaded to database! Rows: ' + csvArray.length);
                    })
                    .catch(error => {
                        alert('Error reading CSV: ' + error);
                    });
                        return false;
                    }
        </script>
    </body>

<script src="../js/mainPage.js"></script>
<script src="../js/cards.js"></script>
