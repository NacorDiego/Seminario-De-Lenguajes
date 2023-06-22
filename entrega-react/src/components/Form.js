import './estilos.css'

const Form = ({ plataformas, generos, handleFormData }) => {
  const handleOnSubmit = event => {
    event.preventDefault()
    const { nombre, genero, plataforma, ordenar } = event.target.elements
    handleFormData({
      nombre: nombre.value,
      genero: genero.value,
      plataforma: plataforma.value,
      ordenar: ordenar.value,
    })
  }

  return (
    <form className="formulario" onSubmit={handleOnSubmit}>
      <div className="campo">
        <label className="campo-label" htmlFor="nombre">
          Nombre
        </label>
        <input className="campo-input" name="nombre" id="nombre" type="text"></input>
      </div>
      <div className="campo">
        <label className="campo-label" htmlFor="genero">
          Genero
        </label>
        <select className="campo-input" name="genero" id="genero">
          <option value="">Seleccionar...</option>
          {generos?.length &&
            generos.map(genero => (
              <option key={genero.id} value={genero.id}>
                {genero.nombre}
              </option>
            ))}
        </select>
      </div>
      <div className="campo">
        <label className="campo-label" htmlFor="plataforma">
          Plataforma
        </label>
        <select className="campo-input" name="plataforma" id="plataforma">
          <option value="" defaultValue="">
            Seleccionar...
          </option>
          {plataformas?.length &&
            plataformas.map(plataforma => (
              <option key={plataforma.id} value={plataforma.id}>
                {plataforma.nombre}
              </option>
            ))}
        </select>
      </div>
      <div className="campo">
        <label className="campo-label" htmlFor="ordenar">
          Ordenar por nombre
        </label>
        <select className="campo-input" name="ordenar" id="ordenar">
          <option value="">Seleccionar...</option>
          <option value="ASC">Ascendente</option>
          <option value="DESC">Descendente</option>
        </select>
      </div>
      <input type="submit" className="boton-filtros" value="Filtrar"></input>
    </form>
  )
}

export default Form
