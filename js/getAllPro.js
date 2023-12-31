
function getAll() {
    fetch('/backend/produtos.php', {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Não autorizado');
            } else {
                throw new Error('Sem rede ou não conseguiu localizar o recurso');
            }
        }
        return response.json();
    })
    .then(data => {
        displayUsers(data);
    })
    .catch(error => alert('Erro na requisição: ' + error));
}

function displayUsers(data) {
    const produtos = data.produtos;  
    const usersDiv = document.getElementById('proList');
    usersDiv.innerHTML = ''; 

    const list = document.createElement('ul');
    produtos.forEach(prod => {
        const listItem = document.createElement('li');
        listItem.textContent = `${prod.id} - ${prod.nome} - ${prod.preco}- ${prod.quantidade}`;
        list.appendChild(listItem);
    });

    usersDiv.appendChild(list);
}
getAll();