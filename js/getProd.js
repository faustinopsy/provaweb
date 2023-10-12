function getProd() {
    const userId = document.getElementById("getProdId").value;

    fetch('/backend/produtos.php?id=' + userId, {
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
        if(!data.status){
            Swal.fire('Produto não encontrado!')
            document.getElementById("inpuNome").value = ''; 
        }else{
            document.getElementById("inputNome").value = data.produtos.nome; 
            document.getElementById("inputPreco").value = data.produtos.preco; 
            document.getElementById("inputQuantidade").value = data.produtos.quantidade; 
        } 
       
    })
    .catch(error => Swal.fire('Coloque algum um id válido!'));
}