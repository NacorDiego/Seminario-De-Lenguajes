const filtros = (event) =>{
  event.preventDefault();

  const nombre = document.querySelector('#nombre').value
  const plataforma = document.querySelector('#plataforma').value
  const genero = document.querySelector('#genero').value
  const letra = document.querySelector('#ordenar').value

  
  let cardsNotFiltered = []
  const regex = new RegExp(nombre,'gi')
  //Filtrar por nombres
  cardsNotFiltered = Array.from(document.querySelectorAll('.titulo-juego')).filter(item => !regex.test(item.innerHTML)) 

  const finalCards = cardsNotFiltered.forEach(item => item.parentElement.parentElement.parentElement.remove())

  return true
}