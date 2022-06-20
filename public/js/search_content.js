
function onTextShare(text){
  alert(text);
}


function onResponseShare(response){
  return response.text();
}


function condividi(event){
    event.preventDefault();
    const inputInvio = event.currentTarget;
   
     const labelInvio = inputInvio.parentNode;
     const form = labelInvio.parentNode;
     const prendiTitolo = form.querySelector("input[name=titolo]");
     const titoloPost = encodeURIComponent(prendiTitolo.value);
     const image = inputInvio.name;
     fetch(condividiPost + "?image=" + image + "&titolo=" + titoloPost).then(onResponseShare).then(onTextShare);
     
}




function onModalClick(event){
  const modalView = document.querySelector('#modalView');
  document.body.classList.remove('no-scroll');
  modalView.classList.add('hidden');
  modalView.innerHTML = '';

}


function modale(event){
  const buttonClick = event.currentTarget;
  const buttonBox = buttonClick.parentNode;
  const postBox = buttonBox.parentNode;
  const modalView = document.querySelector('#modalView');
  const immagine = document.createElement('img');
  const immagineClick = postBox.querySelector('.copertina');
  immagine.src = immagineClick.src;
  document.body.classList.add('no-scroll');
  modalView.style.top = window.pageYOffset + 'px';
  modalView.appendChild(immagine);
  const boxIcona = document.createElement('div');
  const chiudi = document.createElement('img');
  chiudi.src = '/css/image/chiudi_icona.jpg';
  boxIcona.classList.add('boxIcona');
  chiudi.classList.add('chiudi');
  boxIcona.appendChild(chiudi);
  modalView.appendChild(boxIcona);
  chiudi.addEventListener('click', onModalClick); 
  
  const form = document.createElement('form');
  form.setAttribute('method', 'GET');
  const inputTesto = document.createElement('input');
  inputTesto.setAttribute('type', 'text');
  inputTesto.setAttribute('placeholder', 'Inserisci il testo');
  inputTesto.setAttribute('name', 'titolo');
  const inputInvio = document.createElement('input');
  inputInvio.setAttribute('type', 'submit');
  inputInvio.setAttribute('name', immagineClick.src);
  inputInvio.setAttribute('value', 'Condividi');
  form.appendChild(inputInvio);
  form.appendChild(inputTesto);
  modalView.appendChild(form);
  inputInvio.addEventListener('click', condividi);
  modalView.classList.remove('hidden');


}




function onJSON(json) {
    
    const library = document.querySelector('#boxPost');
    library.innerHTML = '';
    if(opzione === 'spotify') {
      console.log(json);
    
    const results = json.albums.items;
    let num_results = results.length;
    
    if(num_results > 10) 
      num_results = 10;
    
    for(let i=0; i<num_results; i++)
    {
      
      const album_data = results[i]
      
      const title = album_data.name; 
      const selected_image = album_data.images[0].url;
      
      const album = document.createElement('div');
      album.classList.add('album');
      
      const img = document.createElement('img');
      img.src = selected_image;
      img.classList.add("copertina");
      
      const caption = document.createElement('span');
      caption.classList.add("albumTitle");
      const buttonBox = document.createElement("div");
      buttonBox.classList.add("buttonBox");
      const buttonShare = document.createElement("input");
      buttonShare.setAttribute("type", "submit");
      buttonShare.setAttribute("value", "Condividi");
      buttonShare.setAttribute("name", selected_image);
      buttonShare.addEventListener('click', modale);
      caption.textContent = title;
      
      album.appendChild(img);
      album.appendChild(caption);
      album.appendChild(buttonBox);
      buttonBox.appendChild(buttonShare);
      
      library.appendChild(album);
    }
  }

  else {
    console.log(json);
    
    const results = json.data;
    let num_results = json.pagination.total_count;
    
    if(num_results > 10) 
      num_results = 10;
    
    for(let i=0; i<num_results; i++)
    {
      
      const album_data = results[i];
      
      const title = album_data.title; 
      const selected_image = album_data.images.downsized.url; 
      
      const album = document.createElement('div');
      album.classList.add('album');
      
      const img = document.createElement('img');
      img.src = selected_image;
      img.classList.add('copertina');
      
      const caption = document.createElement('span');
      caption.classList.add("albumTitle");
      const buttonBox = document.createElement("div");
      buttonBox.classList.add("buttonBox");
      const buttonShare = document.createElement("input");
      buttonShare.setAttribute("type", "submit");
      buttonShare.setAttribute("value", "Condividi");
      buttonShare.setAttribute("name", selected_image);
      buttonShare.addEventListener('click', modale);
      caption.textContent = title;
      
      album.appendChild(img);
      album.appendChild(caption);
      album.appendChild(buttonBox);
      buttonBox.appendChild(buttonShare);
      
      library.appendChild(album);
    }
  }

}
 
function onResponse(response){
    return response.json();
}

function cercaContenuto(event){
    event.preventDefault();
    const form_cerca = {method: 'post', body: new FormData(formCerca)};
    opzione = formCerca.scelta.value;
    fetch(formCerca.getAttribute("action"), form_cerca).then(onResponse).then(onJSON); 
}

var opzione;
const formCerca = document.querySelector('#ricercaPost');
formCerca.addEventListener('submit', cercaContenuto);