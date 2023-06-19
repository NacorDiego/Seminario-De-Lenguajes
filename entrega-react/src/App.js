//Componentes
import HeaderComponent from '../src/components/HeaderComponent'
import DashboardPage from './pages/dashboard/DashboardPage'
//Estilos
import './App.css'
import FooterComponent from './components/FooterComponent'

function App() {
  return (
    <div>
      <div className="App-header">
        <HeaderComponent />
        <div className="centerDashboard">
          <DashboardPage />
        </div>
      </div>
      <FooterComponent />
    </div>
  )
}

export default App
