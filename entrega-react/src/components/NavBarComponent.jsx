import React from 'react'
import { NavLink } from 'react-router-dom'
//Estilos
import './estilos.css'

const NavBarComponent = () => {
  return (
    <nav>
      <ul className="navbar-lista">
        <li>
          <NavLink to="/">Inicio</NavLink>
        </li>
        <li>
          <NavLink to="/generos">Géneros</NavLink>
        </li>
        <li>
          <NavLink to="/plataformas">Plataformas</NavLink>
        </li>
        {/* Acá se agregan los demás navlinks cuando tengamos los componentes */}
      </ul>
    </nav>
  )
}

export default NavBarComponent
