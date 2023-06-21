//Componentes
import { Route, Routes } from 'react-router-dom'
import HeaderComponent from '../src/components/HeaderComponent'
import DashboardPage from './pages/dashboard/DashboardPage'
//Estilos
import './App.css'
import FooterComponent from './components/FooterComponent'

function App() {
  return (
    <>
      <div className="App-header">
        <HeaderComponent />
        <Routes>
          <Route path="/inicio" element={<DashboardPage />}></Route>
          {/* Acá se agregan las demás rutas cuando tengamos los componentes */}
        </Routes>
      </div>
      <FooterComponent />
    </>
  )
}

export default App
