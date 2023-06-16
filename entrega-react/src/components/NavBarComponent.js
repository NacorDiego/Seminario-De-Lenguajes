import React from 'react'
//Estilos
import './styles.css'

const NavBarComponent = () => {
  return (
    <nav>
      <ul className="navbar-lista">
        <li>Home del sitio</li>
        <hr className="separador" />
        <li>Listado de Generos</li>
        <hr className="separador" />
        <li>Listado de Plataformas</li>
      </ul>
    </nav>
  )
}

export default NavBarComponent
