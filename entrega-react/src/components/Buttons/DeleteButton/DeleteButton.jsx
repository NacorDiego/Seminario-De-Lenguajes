import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { BASE_URL } from '../../../hooks/useFetch'
import './DeleteButton.css'
import { useNavigate } from 'react-router-dom'

const DeleteButton = ({ id, path, name }) => {
  const navigate = useNavigate()
  const handleDelete = async () => {
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
    <button className="btn" onClick={handleDelete}>
      <FontAwesomeIcon icon={faTrash} />
    </button>
  )
}

export default DeleteButton
