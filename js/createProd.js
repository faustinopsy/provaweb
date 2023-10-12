document.getElementById('submitButton').addEventListener('click', createUser);

function createUser() {
    const nomeprod = document.getElementById('nomeprod').value;
    const precoprod = document.getElementById('precoprod').value;
    const quantidadeprod = document.getElementById('quantidadeprod').value;
    if (!nomeprod) {
        alert("Por favor, insira um nome!");
        return;
    }
    const usuario = {
        nome: nomeprod,
        preco: precoprod,
        quantidade: quantidadeprod
    };
    fetch('/backend/produtos.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
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
        if(!data.status){
            Swal.fire('Produto já existe!')
        }else{
            Swal.fire('Produto criado!')
        } 
       
    })
    .catch(error => alert('Erro na requisição: ' + error));
}
