import DeleteButton from '../Buttons/DeleteButtons/DeleteButton'
import EditButton from '../Buttons/EditButton/EditButton'
import NewItemButton from '../Buttons/NewItemButton/NewItemButton'
import './Listado.css'

const Listado = ({ results }) => {
  return (
    <>
      <ul className="listado">
        {results.map(item => {
          return (
            <li className="itemList" key={item.id}>
              <div className="contenedor30"></div>
              <div className="contenedor40">
                <span>{item.nombre}</span>
              </div>
              <div className="contenedor30">
                <EditButton id={item.id} />
                <DeleteButton id={item.id} />
              </div>
            </li>
          )
        })}
      </ul>
      <NewItemButton />
    </>
  )
}

export default Listado
