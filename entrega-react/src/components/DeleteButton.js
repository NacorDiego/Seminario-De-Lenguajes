import { faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { BASE_URL } from '../hooks/useFetch'
import { useState } from 'react'

const DeleteButton = ({ endpoint, id }) => {
  const [isLoading, setIsLoading] = useState(false)
  const [error, setError] = useState(null)
  const [isDeleted, setIsDeleted] = useState(false)

  const handleDelete = async event => {
    event.preventDefault()

    try {
      setIsLoading(true)
      setError(null)

      const response = await fetch(`${BASE_URL}${endpoint}/${id}`, { method: 'DELETE' })

      console.log('response', response)

      if (!response.ok) {
        throw new Error('Failed to delete data')
      }

      setIsDeleted(true)
    } catch (error) {
      setError(error.message)
    } finally {
      setIsLoading(false)
    }
  }

  return (
    <button onClick={handleDelete}>
      <FontAwesomeIcon icon={faTrash} />
    </button>
  )
}

export default DeleteButton
