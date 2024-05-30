import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const AddActivity = () => {
  const [dayOne, setDayOne] = useState("");
  const [dayTwo, setDayTwo] = useState("");
  const [dayThree, setDayThree] = useState("");
  const [dayFour, setDayFour] = useState("");
  const [dayFive, setDayFive] = useState("");
  const [longitude, setLongitude] = useState("");
  const [latitude, setLatitude] = useState("");
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    axios
      .post("http://localhost:8002/api/activities", {
        dayOne,
        dayTwo,
        dayThree,
        dayFour,
        dayFive,
        longitude,
        latitude,
      })
      .then((response) => {
        console.log("Success:", response.data);
        navigate("/trips");
      })
      .catch((error) => console.error("Error:", error));
  };

  return (
    <form onSubmit={handleSubmit} className="mb-2" style={{ width: 800 }}>
      <h1>Add Activity</h1>
      <div>
        <label htmlFor="dayOne">Day One</label>
        <p>Activities:</p>
        <textarea
          id="dayOne"
          value={dayOne}
          onChange={(e) => setDayOne(e.target.value)}
          placeholder="Enter additional details here..."
          rows="4"
        ></textarea>
      </div>
      <div>
        <label htmlFor="dayTwo">Day Two</label>
        <p>Activities:</p>
        <textarea
          id="dayTwo"
          value={dayTwo}
          onChange={(e) => setDayTwo(e.target.value)}
          placeholder="Enter additional details here..."
          rows="4"
        ></textarea>
      </div>
      <div>
        <label htmlFor="dayThree">Day Three</label>
        <p>Activities:</p>
        <textarea
          id="dayThree"
          value={dayThree}
          onChange={(e) => setDayThree(e.target.value)}
          placeholder="Enter additional details here..."
          rows="4"
        />
      </div>
      <div>
        <label htmlFor="dayFour">Day Four</label>
        <p>Activities:</p>
        <textarea
          id="dayFour"
          value={dayFour}
          onChange={(e) => setDayFour(e.target.value)}
          placeholder="Enter additional details here..."
          rows="4"
        />
      </div>
      <div>
        <label htmlFor="dayFive">Day Five</label>
        <p>Activities:</p>
        <textarea
          id="dayFive"
          value={dayFive}
          onChange={(e) => setDayFive(e.target.value)}
          placeholder="Enter additional details here..."
          rows="4"
        />
      </div>
      <div>
        <label htmlFor="longitude">Longitude</label>
        <input
          id="longitude"
          type="number"
          value={longitude}
          onChange={(e) => setLongitude(e.target.value)}
          step="0.000001"
          required
        />
      </div>
      <div>
        <label htmlFor="latitude">Latitude</label>
        <input
          id="latitude"
          type="number"
          value={latitude}
          onChange={(e) => setLatitude(e.target.value)}
          step="0.000001"
          required
        />
      </div>
      <button className="btn btn-success btn-sm mt-2" type="submit">
        Submit
      </button>
    </form>
  );
};

export default AddActivity;
