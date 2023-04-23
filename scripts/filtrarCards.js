
function filtrarCards() {

  const allCards = document.querySelector('li.juego')

  const getNombre = allCards.querySelector('')
  
  const nombre = document.querySelector('#nombre').value
  const plataforma = document.querySelector('#plataforma').value
  const genero = document.querySelector('#genero').value
  const letra = document.querySelector('#ordenar').value

  
  let newCards = []
  newCards = getNombre.filter(item => item.match(nombre))
  

  console.log('newCards',newCards)
  return newCards
}