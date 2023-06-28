import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Link } from 'react-router-dom'
import './DeleteButton.css'

const DeleteButton = ({ id }) => {
  return (
    <Link to={`/formEdit/${id}`}>
      <button className="btn">
        <FontAwesomeIcon icon={faTrash} />
      </button>
    </Link>
  )
}

export default DeleteButton
