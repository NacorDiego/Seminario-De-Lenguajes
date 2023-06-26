import { useEffect, useState } from 'react'

export const BASE_URL = 'http://localhost:8000/'

//Hook solo para traer data pasandole parametros opcionales
//Los parametros tienen que ser un objeto con la siguiente estructura:
//{nombreParametro: valorParametro}
const useFetch = (path = 'juegos', params) => {
  const [results, setResults] = useState(null)
  const [status, setStatus] = useState('loading')

  useEffect(() => {
    const fetchData = async () => {
      try {
        setStatus('loading')
        let url = `${BASE_URL}${path}`
        if (params) {
          url = `${url}?${new URLSearchParams(params).toString()}`
        }

        const response = await fetch(url, { method: 'GET' })
        const jsonData = await response.json()
        setResults(jsonData)
        setStatus('success')
      } catch (error) {
        setStatus('error')
        console.log('Error al obtener los datos:', error)
      }
    }
    fetchData()
  }, [path, params])

  return { results, status }
}

export default useFetch
