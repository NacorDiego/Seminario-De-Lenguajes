import { faPencil } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Link } from 'react-router-dom'
import './EditButton.css'

const EditButtons = ({ id }) => {
  return (
    <Link to={`/formEdit/${id}`}>
      <button className="btn">
        <FontAwesomeIcon icon={faPencil} />
      </button>
    </Link>
  )
}

export default EditButtons
