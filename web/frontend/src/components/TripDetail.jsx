import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";

const TripDetail = () => {
  const { id } = useParams();
  const [trip, setTrip] = useState(null);

  useEffect(() => {
    fetch(`http://localhost:8002/api/trips/${id}`)
      .then((response) => response.json())
      .then((data) => setTrip(data))
      .catch((error) => console.error("Error fetching trip:", error));
  }, [id]);

  if (!trip) {
    return <div>Loading...</div>;
  }

  return (
    <div>
      <div>
        <h2>Trip Overview</h2>
        <p>Destinations: {trip.destination}</p>
        <p>
          Travel Dates: {trip.checkIn} - {trip.checkOut}
        </p>
      </div>
      <div>
        <h2>Traveler Information</h2>
        <div>
          <div>
            <p>Name: {trip.name}</p>
            <p>Email: {trip.email}</p>
            <p>Mobile: {trip.mobile}</p>
            {/* <p>Longitude: {trip.longitude}</p> */}
            {/* <p>Latitude: {trip.latitude}</p> */}
          </div>
        </div>
      </div>
      <div></div>
    </div>
  );
};

export default TripDetail;

