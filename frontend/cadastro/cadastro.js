formCadastro = document.getElementById("form-cadastro")
btnCadastrar = document.querySelector(".btn-cadastrar")
nome = document.getElementById("nome")
email = document.getElementById("email")
senha = document.getElementById("senha")
repetirSenha = document.getElementById("repetir-senha")
testando = document.querySelector(".status")

formCadastro.addEventListener("submit", function(event){
    event.preventDefault()
    if(nome.value.length <=0 || email.value.length <= 0){
        testando.textContent = 'Existem campos em branco!'
        testando.style.display = 'block'
        testando.style.color = 'red'
    }
    else{
        validarSenhasFrontEnd()
    }    
})

senha.addEventListener('click', function(){
    testando.style.display = 'none'
})

function validarSenhasFrontEnd(){
    if(senha.value.length >=6){
        if(senha.value === repetirSenha.value){
            testando.style.color = 'green'
            testando.style.display = 'block'
            testando.textContent = 'Cadastrando...'
            formCadastro.submit()
            testando.style.display = 'none'
            nome.value = ''
            email.value = ''
            senha.value = ''
            repetirSenha.value = ''
        }
        else{
            testando.textContent = 'As senhas não coincidem!'
            testando.style.display = 'block'
            testando.style.color = 'red'
        }
    }
    else{
        testando.style.display = 'block'
        testando.textContent = 'A sua senha deve possuir ao menos 6 digitos!'
        testando.style.color = 'red'
    }
    
}

