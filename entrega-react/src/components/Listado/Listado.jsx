import './Listado.css'

const Listado = ({ results }) => {
  console.log(results)
  return (
    <>
      {/* <div></div> */}
      <ul className="listado">
        {results.map(item => {
          return (
            <li className="itemList" key={item.id}>
              <span>{item.nombre}</span>
            </li>
          )
        })}
      </ul>
    </>
  )
}

export default Listado
