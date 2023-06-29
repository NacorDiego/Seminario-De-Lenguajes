import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { BASE_URL } from '../../../hooks/useFetch'
import './DeleteButton.css'

const DeleteButton = ({ id, path, name }) => {
  const handleDelete = async () => {
    const shouldDelete = window.confirm(
      `Desea borrar ${path === 'generos' ? 'el' : 'la'} ${path.split('s')[0]} ${name}?`,
    )
    if (shouldDelete) {
      try {
        await fetch(`${BASE_URL}${path}/${id}`, { method: 'DELETE' })
      } catch (error) {
        console.log(
          `Error eliminar ${path === 'generos' ? 'el' : 'la'} ${path.split('s')[0]} ${name}?`,
          error,
        )
      }
    }
  }
  return (
    <button className="btn" onClick={handleDelete}>
      <FontAwesomeIcon icon={faTrash} />
    </button>
  )
}

export default DeleteButton
