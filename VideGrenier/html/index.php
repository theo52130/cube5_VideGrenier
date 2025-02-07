<?php
$host = 'mysql_db';
$dbname = 'mydatabase';
$user = 'myuser';
$pass = 'mypassword';

$maxTries = 10;
$tries = 0;

while ($tries < $maxTries) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        break;
    } catch(PDOException $e) {
        $tries++;
        if ($tries === $maxTries) {
            die("Erreur de connexion après $maxTries tentatives : " . $e->getMessage());
        }
        sleep(2);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des items</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Liste des items</h1>
    <button class="button add-button" onclick="openModal()">Ajouter un item</button>
    
    <?php
    try {
        $stmt = $pdo->query("SELECT * FROM items");
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Description</th><th>Prix</th><th>Date création</th><th>Actions</th></tr>";
        
        foreach($items as $item) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['id']) . "</td>";
            echo "<td>" . htmlspecialchars($item['name']) . "</td>";
            echo "<td>" . htmlspecialchars($item['description']) . "</td>";
            echo "<td>" . htmlspecialchars($item['price']) . "€</td>";
            echo "<td>" . htmlspecialchars($item['created_at']) . "</td>";
            echo "<td class='actions'>";
            echo "<button class='button edit-button' onclick='editItem(" . json_encode($item) . ")'>Modifier</button>";
            echo "<button class='button delete-button' onclick='deleteItem(" . $item['id'] . ")'>Supprimer</button>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>

    <!-- Modal pour ajouter/modifier -->
    <div id="itemModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Ajouter un item</h2>
            <form id="itemForm">
                <input type="hidden" id="itemId">
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Prix:</label>
                    <input type="number" id="price" step="0.01" required>
                </div>
                <button type="submit" class="button add-button">Sauvegarder</button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('itemModal');
        const form = document.getElementById('itemForm');
        let isEditing = false;

        function openModal() {
            modal.style.display = 'block';
            isEditing = false;
            document.getElementById('modalTitle').textContent = 'Ajouter un item';
            form.reset();
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function editItem(item) {
            isEditing = true;
            document.getElementById('modalTitle').textContent = 'Modifier un item';
            document.getElementById('itemId').value = item.id;
            document.getElementById('name').value = item.name;
            document.getElementById('description').value = item.description;
            document.getElementById('price').value = item.price;
            modal.style.display = 'block';
        }

        async function deleteItem(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet item ?')) {
                try {
                    const response = await fetch(`/api.php?id=${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                    if (response.ok) {
                        location.reload();
                    } else {
                        throw new Error('Erreur lors de la suppression');
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    alert('Erreur lors de la suppression: ' + error.message);
                }
            }
        }

        form.onsubmit = async (e) => {
            e.preventDefault();
            const formData = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value,
                price: document.getElementById('price').value
            };

            try {
                const method = isEditing ? 'PUT' : 'POST';
                const itemId = document.getElementById('itemId').value;
                const url = isEditing ? `/api.php?id=${itemId}` : '/api.php';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                console.log('Succès:', result);
                location.reload();
            } catch (error) {
                console.error('Erreur:', error);
                alert('Erreur lors de la sauvegarde: ' + error.message);
            }
        };

        // Fermer la modal si on clique en dehors
        window.onclick = function(event) {
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>