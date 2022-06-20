function onModalClick(event){
    const modalView = document.querySelector('#modalView');
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = '';
  
  }

  function onJSONLikeUsers(json){
    const modalView = document.querySelector('#modalView');
    const boxIcona = document.createElement('div');
    const chiudi = document.createElement('img');
    chiudi.src = '/css/image/chiudi_icona.jpg';
    boxIcona.classList.add('boxIcona');
    chiudi.classList.add('chiudi');
    boxIcona.appendChild(chiudi);
    modalView.appendChild(boxIcona);
    chiudi.addEventListener('click', onModalClick);
    
    const boxLikeUser = document.createElement('div');
    boxLikeUser.classList.add('boxLikeUser');
    modalView.appendChild(boxLikeUser);
    for(user of json) {
        const utente = document.createElement('span');
        utente.textContent = user.nomeUtente;
        boxLikeUser.appendChild(utente);
    }
    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset + 'px';
    modalView.classList.remove('hidden');
}


  function onResponseLikeUsers(response){
      return response.json();
  }

function modale(event){
    const contatoreClick = event.currentTarget;
    const buttonBox = contatoreClick.parentNode;
    const boxPost = buttonBox.parentNode;
    
    fetch(like_users + "?idPost=" + boxPost.id).then(onResponseLikeUsers).then(onJSONLikeUsers);
}

function onJSONAddLike(json){
    console.log(json);
    for(box of json) {
        const idPost=box.idPost;
        const boxPost = document.getElementById(idPost);
        const contatoreLike = boxPost.querySelector('.contatoreLike');
        contatoreLike.textContent = "Piace a " + box.numeroLikes + " persone";
    }
    
}



function onResponseAddLike(response){
    return response.json();
}




function aggiungiLike(event){
    const tastoLike = event.currentTarget;
    const buttonBox = tastoLike.parentNode;
    const boxPost = buttonBox.parentNode;
    
    fetch(aggiungi_like + "?idPost=" + boxPost.id).then(onResponseAddLike).then(onJSONAddLike);
}




function onJSONLike(json){
    
    console.log(json);
    for(box of json) {
    const idPost=box.idPost;
    const boxPost = document.getElementById(idPost);
    const buttonBox = document.createElement("div");
    buttonBox.classList.add("buttonBox");
    const contatoreLike = document.createElement('span');
    contatoreLike.classList.add("contatoreLike");
    contatoreLike.textContent = "Piace a " + box.numeroLikes + " persone";
    const buttonLike = document.createElement("input");
    buttonLike.setAttribute("type", "submit");
    buttonLike.setAttribute("value", "Mi piace");
    
    buttonBox.appendChild(buttonLike);
    buttonBox.appendChild(contatoreLike);
    boxPost.appendChild(buttonBox);
    buttonLike.addEventListener('click', aggiungiLike);
    contatoreLike.addEventListener('click', modale);

    }

    

}


function onResponseLike(response){
  
    return response.json();
}

function onJSON(json)
{
    
    const boxPosts = document.querySelector('#boxPosts');
    boxPosts.innerHTML = '';
    for(post of json){
        const boxPost = document.createElement('div');
        boxPost.classList.add("boxPost");
        const boxUtente = document.createElement('div');
        boxUtente.classList.add("boxUtente");
        const nomeUtente = document.createElement('span');
        nomeUtente.classList.add("nomeUtente");
        nomeUtente.textContent = post.nomeUtente;
        const imgProfilo = document.createElement('img');
        imgProfilo.classList.add('imgProfilo');
        imgProfilo.src = post.Imageuser;
        const boxUrlPost = document.createElement('div');
        boxUrlPost.classList.add("boxUrlPost");
        const urlPost = document.createElement('img');
        urlPost.classList.add("urlPost");
        urlPost.src = post.ImagePost;
        const titoloPost = document.createElement('div');
        titoloPost.classList.add('titoloPost');
        titoloPost.textContent = post.titoloPost;
        const dataPost = document.createElement('span');
        dataPost.classList.add("dataPost");
        dataPost.textContent = post.dataPost;
        const buttonBox = document.createElement("div");
        buttonBox.classList.add("buttonBox");
        boxPost.setAttribute("id", post.idPost);


        boxPost.appendChild(boxUtente);
        boxUtente.appendChild(imgProfilo);
        boxUtente.appendChild(nomeUtente);
        boxUrlPost.appendChild(buttonBox);
        boxPost.appendChild(boxUrlPost);
        boxUrlPost.appendChild(titoloPost);
        boxUrlPost.appendChild(urlPost);
        boxUrlPost.appendChild(buttonBox);
        boxUrlPost.appendChild(dataPost);
        boxPosts.appendChild(boxPost);
        
        fetch(stampa_like + "?idPost=" + post.idPost).then(onResponseLike).then(onJSONLike);


    }
}

function onResponse(response){
    return response.json();
}


fetch(utenti_seguiti).then(onResponse).then(onJSON);