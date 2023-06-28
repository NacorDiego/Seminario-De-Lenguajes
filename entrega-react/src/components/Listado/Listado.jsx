import EditButtons from '../EditButton/EditButton'
import './Listado.css'

const Listado = ({ results }) => {
  return (
    <ul className="listado">
      {results.map(item => {
        return (
          <li className="itemList" key={item.id}>
            <div className="contenedor30"></div>
            <div className="contenedor40">
              <span>{item.nombre}</span>
            </div>
            <div className="contenedor30">
              <EditButtons id={item.id} />
            </div>
          </li>
        )
      })}
    </ul>
  )
}

export default Listado
