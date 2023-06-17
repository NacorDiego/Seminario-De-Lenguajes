import { useEffect, useState } from 'react'

const BASE_URL = 'http://localhost:8000/'

const useFetch = path => {
  const [data, setData] = useState(null)
  const [status, setStatus] = useState('loading')

  useEffect(() => {
    if (!path) {
      setStatus('error')
      return
    }

    const fetchData = async () => {
      try {
        const response = await fetch(`${BASE_URL}${path}`, {
          method: 'GET',
        })
        const data = await response.json()
        setData(data)
        setStatus('success')
      } catch (error) {
        setStatus('error')
        console.log('Error al obtener los datos:', error)
      }
    }
    fetchData()
  }, [])

  return { data, status }
}

export default useFetch
