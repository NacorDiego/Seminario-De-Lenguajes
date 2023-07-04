import { Link, useNavigate } from 'react-router-dom'
import NewItemButton from '../NewItemButton/NewItemButton'
import CustomButtomComponent from '../CustomButtomComponent'
import './Listado.css'
import { BASE_URL } from '../../hooks/useFetch'
import { faPencil, faTrash } from '@fortawesome/free-solid-svg-icons'

const Listado = ({ path, results }) => {
  const navigate = useNavigate()

  const handleDelete = async (id, name) => {
    const shouldDelete = window.confirm(
      `Desea borrar ${path === 'generos' ? 'el' : 'la'} ${path.split('s')[0]} ${name}?`,
    )

    if (shouldDelete) {
      try {
        const response = await fetch(`${BASE_URL}${path}/${id}`, { method: 'DELETE' })
        const dataJson = await response.json()
        const message = dataJson.message
        window.location.reload()
        navigate(`/${path}`, { state: { errorType: 'success', responseText: message } })
      } catch (error) {
        console.log(
          `Error eliminar ${path === 'generos' ? 'el' : 'la'} ${path.split('s')[0]} ${name}?`,
          error,
        )
      }
    }
  }

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
                <Link to={`/formEdit/${item.id}/${path}`}>
                  <CustomButtomComponent buttonAction={faPencil} openBy={'edit'} />
                </Link>
                <CustomButtomComponent
                  handleAction={() => {
                    handleDelete(item.id, item.nombre)
                  }}
                  buttonAction={faTrash}
                  openBy={'delete'}
                />
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
