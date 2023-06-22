import { useEffect, useState } from 'react'

const BASE_URL = 'http://localhost:8000/'

const useFetch = (path = 'juegos', method = 'GET', data) => {
  const [results, setResults] = useState(null)
  const [status, setStatus] = useState('loading')

  useEffect(() => {
    const fetchData = async () => {
      try {
        setStatus('loading')
        let url = `${BASE_URL}${path}`
        if (data) {
          url = `${url}?${new URLSearchParams(data).toString()}`
        }

        const response = await fetch(url, { method })
        const jsonData = await response.json()
        setResults(jsonData)
        setStatus('success')
      } catch (error) {
        setStatus('error')
        console.log('Error al obtener los datos:', error)
      }
    }
    fetchData()
  }, [path, method, data])

  return { results, status }
}

export default useFetch
