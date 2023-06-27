//Componentes
import { Route, Routes } from 'react-router-dom'
import HeaderComponent from './components/HeaderComponent'
import DashboardPage from './pages/dashboard/DashboardPage'
//Estilos
import './App.css'
import FooterComponent from './components/FooterComponent'
import GenerosPage from './pages/generos/GenerosPage'
import PlataformasPage from './pages/plataformas/PlataformasPage'
import FormEdit from './components/FormEdit'

function App() {
  return (
    <>
      <div className="app-header">
        <HeaderComponent />
        <Routes>
          <Route path="/" element={<DashboardPage />}></Route>
          <Route path="/generos" element={<GenerosPage />}></Route>
          <Route path="/plataformas" element={<PlataformasPage />}></Route>
          <Route path="/formEdit/:id" element={<FormEdit />} />
          {/* Acá se agregan las demás rutas cuando tengamos los componentes */}
        </Routes>
      </div>
      <FooterComponent />
    </>
  )
}

export default App
