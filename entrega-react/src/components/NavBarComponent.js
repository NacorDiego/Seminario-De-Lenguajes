import React from 'react'
import { NavLink } from 'react-router-dom'
//Estilos
import './estilos.css'

const NavBarComponent = () => {
  return (
    <nav>
      <ul className="navbar-lista">
        <li>
          <NavLink className="active" to="/">
            Inicio
          </NavLink>
        </li>
        {/* Acá se agregan los demás navlinks cuando tengamos los componentes */}
      </ul>
    </nav>
  )
}

export default NavBarComponent
