import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { BASE_URL } from '../hooks/useFetch'

//Por el momento lo voy a dejar asi nomas pero la idea seria mejorarlo
// Lo incorpore en juegos pero la idea es usarlo solo en plataformas y generos

const DeleteButton = ({ endpoint, id }) => {
  const handleDelete = async event => {
    event.preventDefault()

    try {
      const response = await fetch(`${BASE_URL}${endpoint}/${id}`, { method: 'DELETE' })

      console.log('response', response)

      if (!response.ok) {
        throw new Error('Failed to delete data')
      }
    } catch (error) {
      console.log('error', error)
    }
  }

  return (
    <button onClick={handleDelete}>
      <FontAwesomeIcon icon={faTrash} />
    </button>
  )
}

export default DeleteButton
