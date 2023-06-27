import { faPencil } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Link } from 'react-router-dom'

const EditButtons = ({ id }) => {
  return (
    <Link to={`/formEdit/${id}`}>
      <button>
        <FontAwesomeIcon icon={faPencil} />
      </button>
    </Link>
  )
}

export default EditButtons
