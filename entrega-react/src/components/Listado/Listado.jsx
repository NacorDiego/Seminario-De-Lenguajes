import EditButtons from '../EditButton'
import './Listado.css'

const Listado = ({ results }) => {
  return (
    <ul className="listado">
      {results.map(item => {
        return (
          <li className="itemList" key={item.id}>
            <span>{item.nombre}</span>
            <EditButtons id={item.id} item={item} />
          </li>
        )
      })}
    </ul>
  )
}

export default Listado
