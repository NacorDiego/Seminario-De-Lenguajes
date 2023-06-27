import { useEffect } from 'react'
import { BASE_URL } from './useFetch'

const useUpdate = (path, id, jsonData) => {
  useEffect(() => {
    if (!jsonData?.nombreGenero) return
    const update = async () => {
      try {
        const response = await fetch(`${BASE_URL}${path}/${id}`, {
          method: 'PUT',
          body: JSON.stringify(jsonData),
        })
        console.log('response', response)
      } catch (error) {
        console.log('Error actualizando el genero', error)
      }
    }
    update()
  }, [path, id, jsonData])
}

export default useUpdate
