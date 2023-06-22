import { useEffect, useState } from 'react'

const BASE_URL = 'http://localhost:8000/'

const useFetch = (path = 'juegos', method = 'GET', data = {}) => {
  const [results, setResults] = useState(null)
  const [status, setStatus] = useState('loading')

  let url = `${BASE_URL}${path}`
  if (Object.keys(data).length) {
    url = `${url}?${new URLSearchParams(data).toString()}`
  }

  useEffect(() => {
    if (!path) {
      setStatus('error')
      return
    }

    const fetchData = async () => {
      try {
        setStatus('loading')
        const response = await fetch(url, {
          method: method,
        })
        const jsonData = await response.json()
        setResults(jsonData)
        setStatus('success')
      } catch (error) {
        setStatus('error')
        console.log('Error al obtener los datos:', error)
      }
    }
    fetchData()
  }, [method, data, url])

  return { results, status }
}

export default useFetch
