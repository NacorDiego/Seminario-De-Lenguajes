import DeleteButton from '../Buttons/DeleteButtons/DeleteButton'
import EditButton from '../Buttons/EditButton/EditButton'
import NewItemButton from '../Buttons/NewItemButton/NewItemButton'
import './Listado.css'

const Listado = ({ path, results }) => {
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
                <EditButton id={item.id} path={path} />
                <DeleteButton id={item.id} path={path} name={item.nombre} />
              </div>
            </li>
          )
        })}
      </ul>
      <NewItemButton path={path} />
    </>
  )
}

export default Listado
