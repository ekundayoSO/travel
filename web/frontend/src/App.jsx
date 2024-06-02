import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import AddTrip from "./components/AddTrip";
import TripList from "./components/TripList";
import EditTrip from "./components/EditTrip";
import TripDetail from "./components/TripDetail";
import ActivityList from "./components/ActivityList";
import AddActivity from "./components/AddActivity";
import EditActivity from "./components/EditActivity";
import ActivityDetail from "./components/ActivityDetail";
import Itinerary from "./components/Itinerary";

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<TripList />} />
        <Route path="/addTrip" element={<AddTrip />} />
        <Route path="/trips/:id" element={<TripDetail />} />
        <Route path="/edit/:id" element={<EditTrip />} />
    
        <Route path="/activities" element={<ActivityList />} />
        {/* <Route path="/addActivity" element={<AddActivity />} /> */}
        <Route path="/editActivity/:id" element={<EditActivity />} />
        <Route path="/activities/:id" element={<ActivityDetail />} /> 
        <Route path="/add" element={<Itinerary />} />
       
      </Routes>
    </Router>
  );
};

export default App;
