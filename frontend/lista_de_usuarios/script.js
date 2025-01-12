var btn = document.querySelector(".teste")


document.addEventListener('DOMContentLoaded',function(){
    fetch('../../backend/dados.php')
        .then(response => response.json())
        .then(data => {
            var container = document.getElementById("usuarios-container")
            data.forEach(item => {
                var usuario = document.createElement("div")
                usuario.classList.add("usuario")
                var idTexto = document.createElement("span")
                idTexto.classList.add("id-texto")
                idTexto.textContent =  `${item.id}`
                usuario.appendChild(idTexto)
                var nomeTexto = document.createElement("span")
                nomeTexto.classList.add("nome-texto")
                nomeTexto.textContent =  `${item.nome}`
                usuario.appendChild(nomeTexto)
                var emailTexto = document.createElement("span")
                emailTexto.classList.add("nome-texto")
                emailTexto.textContent =  `${item.email}`
                var editarExcluir = document.createElement("div")
                editarExcluir.classList.add("editar-excluir")
                var btnEditar = document.createElement("a")
                btnEditar.href =`../../backend/editar.php?id=${item.id}`
                btnEditar.textContent = 'Editar'
                btnEditar.classList.add("btn-editar")
                editarExcluir.appendChild(btnEditar)
                var btnExcluir = document.createElement("a")
                btnExcluir.href =`../../backend/excluir.php?id=${item.id}`
                btnExcluir.textContent = 'Excluir'
                btnExcluir.classList.add("btn-excluir")
                editarExcluir.appendChild(btnExcluir)
                emailTexto.appendChild(editarExcluir)
                usuario.appendChild(emailTexto)
                container.appendChild(usuario)
            })
            
        })
        .catch(error => console.error('Erro:', error));
})

window.onpopstate = function(event){
    window.location.href = "index.html"
}


