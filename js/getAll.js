function getAll() {
    fetch('http://localhost:8082/backend/usuarios.php', {
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
        if(data.status){
            displayUsers(data);
            
        }else{
            Swal.fire('Nenhum resultado encontrado!')
        }
       
    })
    .catch(error => alert('Erro na requisição: ' + error));
}

function displayUsers(data) {
    const users = data.usuarios;  
    const usersDiv = document.getElementById('usersList');
    usersDiv.innerHTML = ''; 

    const list = document.createElement('ul');
    users.forEach(user => {
        const listItem = document.createElement('li');
        listItem.textContent = `${user.id} - ${user.nome} - ${user.email}`;
        list.appendChild(listItem);
    });

    usersDiv.appendChild(list);
}
getAll();