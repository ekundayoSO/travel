import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import AddTrip from "./components/AddTrip";
import TripList from "./components/TripList";
import ActivityList from "./components/ActivityList";
import EditTrip from "./components/EditTrip";
import TripDetail from "./components/TripDetail";
import AddActivity from "./components/AddActivity";
import EditActivity from "./components/EditActivity";
import ActivityDetail from "./components/ActivityDetail";

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<TripList />} />
        <Route path="/addTrip" element={<AddTrip />} />
        <Route path="/edit/:id" element={<EditTrip />} />
        <Route path="/trips/:id" element={<TripDetail />} />
        <Route path="/activity" element={<ActivityList />} />
        <Route path="/addActivity" element={<AddActivity />} />
        <Route path="/editac/:id" element={<EditActivity />} />
        <Route path="/activities/:id" element={<ActivityDetail />} />
      </Routes>
    </Router>
  );
};

export default App;
