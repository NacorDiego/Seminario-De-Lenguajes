const filtros = (event) =>{
  //Evitamos que cada vez que se mande un submit se vuelva a cargar la pagina
  event.preventDefault();
  //Mostramos todos los juegos
  Array.from(document.querySelectorAll('.titulo-juego')).forEach(item => item.parentElement.parentElement.parentElement.style.display = '')

  //Obtenemos los valores de los filtros
  const nombre = document.querySelector('#nombre').value
  const plataforma = document.querySelector('#plataforma').value
  const genero = document.querySelector('#genero').value
  const letra = document.querySelector('#ordenar').value

  
  let cardsNotFiltered = []
  //Filtramos por nombre
  const regex = new RegExp(nombre,'gi')
  //Nos quedamos con todos los juegos que no contenga el nombre que se busca
  cardsNotFiltered = Array.from(document.querySelectorAll('.titulo-juego')).filter(item => !regex.test(item.innerHTML)) 
  //Ocultamos los juegos que no contengan el nombre que se busca
  cardsNotFiltered.forEach(item => item.parentElement.parentElement.parentElement.style.display = 'none')


  
  return true
}