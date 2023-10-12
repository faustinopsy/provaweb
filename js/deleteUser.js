function deleteUser() {
    const userId = document.getElementById("getUserId").value;
    if (!userId) {
        Swal.fire('Por favor, insira um id!')
        return;
    }
    fetch('/backend/usuarios.php?id=' + userId, {
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
            Swal.fire('Excluisdo com sucesso!')
            document.getElementById("inpuNome").value = ''; 
        } 
        
    })
    .catch(error => Swal.fire('Coloque algum um id válido!'));
}