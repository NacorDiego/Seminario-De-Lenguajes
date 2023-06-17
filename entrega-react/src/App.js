//Componentes
import HeaderComponent from '../src/components/HeaderComponent'
import DashboardPage from './pages/dashboard/DashboardPage'
//Estilos
import './App.css'

function App() {
  return (
    <div className="App-header">
      <HeaderComponent />
      <div className="centerDashboard">
        <DashboardPage />
      </div>
    </div>
  )
}

export default App
