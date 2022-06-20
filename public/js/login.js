function validazioneLogIn(event){
    if(logIn.nomeUtente.value.length == 0 || logIn.password.value.length == 0){
        alert("Inserisci username e password");
        event.preventDefault();
    }
}

const logIn = document.querySelector('#login');
logIn.addEventListener('submit', validazioneLogIn);



