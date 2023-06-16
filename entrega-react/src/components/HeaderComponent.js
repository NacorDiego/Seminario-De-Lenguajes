import logo from '../logo.svg'
//Componentees
import NavBarComponent from './NavBarComponent'
//Estilos
import './styles.css'

const HeaderComponent = () => {
  return (
    <header className="header">
      <div className="centerHeader">
        <img className="imagen-logo" src={logo} alt="logo" />
        <h1>Pagina de videojuegos</h1>
        <NavBarComponent />
      </div>
    </header>
  )
}

export default HeaderComponent
