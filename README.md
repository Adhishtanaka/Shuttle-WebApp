# Shuttle WebApp

## Overview

This PHP-based web application serves as the admin panel for the Shuttle Tracking System. It allows university administrators to track shuttle buses in real-time and manage driver accounts. The system enables bus drivers to sign up with special credentials and provides details such as driver and owner names, images, bus photos, and the number of passengers currently using the app.

## Features

- **Driver Authentication**: Allows bus drivers to sign up and receive special passwords.
- **Bus Tracking**: Displays real-time location updates of shuttle buses.
- **Admin Control**: University administrators can track buses, view details, and manage users.
- **Firebase Integration**: Uses Firebase for authentication and database management.
- **Passenger Monitoring**: Tracks how many people are in the bus.

## Setup Instructions

### Prerequisites

- Install [XAMPP](https://www.apachefriends.org/download.html) to run a local Apache server with PHP and MySQL.
- Ensure `composer` is installed in your system. If not, install it from [Composer's official site](https://getcomposer.org/download/).

### Installation

1. **Clone the Repository**:
   ```sh
   git clone https://github.com/Adhishtanaka/Shuttle-WebApp.git
   cd Shuttle-WebApp
   ```

2. **Install Dependencies** (Run inside the `shuttle/` directory):
   ```sh
   cd shuttle
   composer install
   ```

3. **Configure Database**:
   - Import `userdb.sql` into your MySQL database.
   - Update database credentials in `config.php`.

4. **Run the Application**:
   - Start Apache and MySQL in XAMPP.
   - Place the project in `htdocs` (e.g., `C:\xampp\htdocs\Shuttle-WebApp`).
   - Open a browser and go to `http://localhost/Shuttle-WebApp/`.

## Usage

- **Drivers**: Sign up and provide shuttle details.
- **Admins**: View and manage shuttle information from the dashboard.

## Contributors

<table>
  <tr>
    <td align="center">
       <img src="https://github.com/tdulshan3.png" width="80px;" alt="Thusara Dulshan"/><br />
       <a href="https://github.com/tdulshan3"><sub><b>Thusara Dulshan</b></sub></a>
    </td>
    <td align="center">
       <img src="https://github.com/TanujMalinda.png" width="80px;" alt="Tanuj Malinda"/><br />
       <a href="https://github.com/TanujMalinda"><sub><b>Tanuj Malinda</b></sub></a>
    </td>
      <td align="center">
       <img src="https://github.com/dilinamewan.png" width="80px;" alt="Dilina Mewan"/><br />
       <a href="https://github.com/dilinamewan"><sub><b>Dilina Mewan</b></sub></a>
    </td>
       </tr>
   <tr>
  <td align="center">
       <img src="https://github.com/Adhishtanaka.png" width="80px;" alt="Adhishtanaka"/><br />
       <a href="https://github.com/Adhishtanaka"><sub><b>Adhishtanaka Kulasooriya</b></sub></a>
    </td>
    <td align="center">
       <img src="https://github.com/Siluni28270.png" width="80px;" alt="Siluni"/><br />
       <a href="https://github.com/Siluni28270"><sub><b>Siluni Sadanima</b></sub></a>
    </td>
       <td align="center">
       <img src="https://github.com/Madharaa.png" width="80px;" alt="Madara"/><br />
       <a href="https://github.com/Madharaa"><sub><b>Madhara Dulanjali</b></sub></a>
    </td>
  </tr>
      <tr>
  <td align="center">
       <img src="https://github.com/ThilakarathnaMTM.png" width="80px;" alt="Tharuka"/><br />
       <a href="https://github.com/ThilakarathnaMTM"><sub><b>Tharuka Thilakarathna</b></sub></a>
    </td>
    <td align="center">
       <img src="https://github.com/SheshaniWimarshana.png" width="80px;" alt="Sheshani"/><br />
       <a href="https://github.com/SheshaniWimarshana"><sub><b>Sheshani Wimarshana</b></sub></a>
    </td>
         <td align="center">
       <img src="https://github.com/Nethmijayasinghee.png" width="80px;" alt="Nethmi"/><br />
       <a href="https://github.com/Nethmijayasinghee"><sub><b>Nethmi Jayasinghee</b></sub></a>
    </td>
  </tr>
</table>

If you find any bugs or want to suggest improvements, feel free to open an issue or pull request on the [GitHub repository](https://github.com/Adhishtanaka/Shuttle-app/pulls).

## License
This project is licensed under the MIT License. See [MIT License](LICENSE) for details.

Made with ❤️ using PHP.

