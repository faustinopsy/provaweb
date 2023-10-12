function deleteProd() {
    const prodId = document.getElementById("getProdId").value;
    if (!prodId) {
        Swal.fire('Por favor, insira um id!')
        return;
    }
    fetch('/backend/produtos.php?id=' + prodId, {
        method: 'DELETE'
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
            Swal.fire('Não pode Deletar!')
        }else{
            Swal.fire('Excluido com sucesso!')
            document.getElementById("inpuNome").value = ''; 
        } 
        
    })
    .catch(error => Swal.fire('Coloque algum um id válido!'));
}