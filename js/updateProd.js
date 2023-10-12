function updateProd() {
    const prodId = document.getElementById("getProdId").value;
    const nomePro = document.getElementById("inputNome").value;
    const precoPro = document.getElementById("inputPreco").value;
    const quantidadePro = document.getElementById("inputQuantidade").value;
    const usuarioAtualizado = {
        nome: nomePro,
        preco: precoPro,
        quantidade: quantidadePro
    };
    if (!prodId) {
        Swal.fire('Por favor, insira um id!')
        return;
    }
    fetch('/backend/produtos.php?id=' + prodId, { 
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuarioAtualizado)
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
            Swal.fire('Não foi possivel atualizar!')
        }else{
            Swal.fire('Atualizado com sucesso!')
        } 
        
    })
    .catch(error => alert('Erro na requisição: ' + error));
}
