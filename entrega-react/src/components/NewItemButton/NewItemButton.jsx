import { faPlus } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Link } from 'react-router-dom'
import './NewItemButton.css'

const NewItemButton = ({ path }) => {
  return (
    <Link to={`/formAdd/${path}`}>
      <button className="btn-nuevo">
        <FontAwesomeIcon className="btn-nuevo__icono" icon={faPlus} />
        Agregar
      </button>
    </Link>
  )
}

export default NewItemButton
