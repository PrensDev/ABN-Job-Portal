USE [master]
GO
/****** Object:  Database [ABN_Job_Portal]    Script Date: 23/02/2021 12:25:51 pm ******/
CREATE DATABASE [ABN_Job_Portal]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'ABN_Job_Portal', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER01\MSSQL\DATA\ABN_Job_Portal.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'ABN_Job_Portal_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER01\MSSQL\DATA\ABN_Job_Portal_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [ABN_Job_Portal] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [ABN_Job_Portal].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ARITHABORT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [ABN_Job_Portal] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [ABN_Job_Portal] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET  ENABLE_BROKER 
GO
ALTER DATABASE [ABN_Job_Portal] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [ABN_Job_Portal] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET RECOVERY FULL 
GO
ALTER DATABASE [ABN_Job_Portal] SET  MULTI_USER 
GO
ALTER DATABASE [ABN_Job_Portal] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [ABN_Job_Portal] SET DB_CHAINING OFF 
GO
ALTER DATABASE [ABN_Job_Portal] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [ABN_Job_Portal] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [ABN_Job_Portal] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [ABN_Job_Portal] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'ABN_Job_Portal', N'ON'
GO
ALTER DATABASE [ABN_Job_Portal] SET QUERY_STORE = OFF
GO
USE [ABN_Job_Portal]
GO
/****** Object:  Table [dbo].[Employers]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employers](
	[employerID] [int] IDENTITY(1,1) NOT NULL,
	[companyName] [varchar](max) NOT NULL,
	[street] [varchar](max) NOT NULL,
	[brgyDistrict] [varchar](max) NOT NULL,
	[cityProvince] [varchar](max) NOT NULL,
	[contactNumber] [varchar](450) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[website] [varchar](max) NULL,
	[description] [varchar](max) NOT NULL,
	[profilePic] [varchar](max) NULL,
 CONSTRAINT [PK_employerID@Employers] PRIMARY KEY CLUSTERED 
(
	[employerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JobPosts]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JobPosts](
	[jobPostID] [int] IDENTITY(1,1) NOT NULL,
	[employerID] [int] NOT NULL,
	[jobTitle] [varchar](max) NOT NULL,
	[jobType] [varchar](max) NOT NULL,
	[field] [varchar](max) NOT NULL,
	[description] [varchar](max) NOT NULL,
	[responsibilities] [varchar](max) NOT NULL,
	[skills] [varchar](max) NOT NULL,
	[experiences] [varchar](max) NOT NULL,
	[education] [varchar](max) NOT NULL,
	[minSalary] [money] NOT NULL,
	[maxSalary] [money] NOT NULL,
	[dateCreated] [datetime] NOT NULL,
	[dateModified] [datetime] NULL,
	[jobPostFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_jobPostID@JobPosts] PRIMARY KEY CLUSTERED 
(
	[jobPostID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  View [dbo].[Posts]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/* ============================================================================== */
/*                                    VIEWS                                       */
/* ============================================================================== */

-- Posts View
CREATE VIEW [dbo].[Posts] 
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict]
		, [Employers].[cityProvince]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		 AS [location]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [JobPosts].[jobPostFlag] = 1

GO
/****** Object:  View [dbo].[JobDetails]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Job Details
CREATE VIEW [dbo].[JobDetails]
AS
SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Employers].[contactNumber]
		, [Employers].[email]
		, [Employers].[website]
	FROM [JobPosts]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
GO
/****** Object:  Table [dbo].[Applications]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Applications](
	[applicationID] [int] IDENTITY(1,1) NOT NULL,
	[jobPostID] [int] NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[headline] [varchar](max) NULL,
	[description] [varchar](max) NULL,
	[education] [varchar](max) NULL,
	[skills] [varchar](max) NULL,
	[experiences] [varchar](max) NULL,
	[resumeFile] [varchar](max) NULL,
	[lastUpdated] [varchar](max) NULL,
	[status] [varchar](max) NOT NULL,
	[dateApplied] [datetime] NOT NULL,
	[dateStatus] [datetime] NULL,
 CONSTRAINT [PK_applicationID@Applications] PRIMARY KEY CLUSTERED 
(
	[applicationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Bookmarks]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Bookmarks](
	[bookmarkID] [int] IDENTITY(1,1) NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[jobPostID] [int] NOT NULL,
	[dateBookmarked] [datetime] NOT NULL,
 CONSTRAINT [PK_bookmarkID@Bookmarks] PRIMARY KEY CLUSTERED 
(
	[bookmarkID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JBSK_StatusNotifications]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JBSK_StatusNotifications](
	[notificationID] [int] IDENTITY(1,1) NOT NULL,
	[applicationID] [int] NOT NULL,
	[readFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_notificationID@JBSK_StatusNotifications] PRIMARY KEY CLUSTERED 
(
	[notificationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[JobSeekers]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[JobSeekers](
	[jobseekerID] [int] IDENTITY(1,1) NOT NULL,
	[firstName] [varchar](max) NOT NULL,
	[middleName] [varchar](max) NULL,
	[lastName] [varchar](max) NOT NULL,
	[birthDate] [date] NOT NULL,
	[gender] [varchar](max) NOT NULL,
	[cityProvince] [varchar](max) NOT NULL,
	[contactNumber] [varchar](450) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[profilePic] [varchar](max) NULL,
 CONSTRAINT [PK_jobseekerID@JobSeekers] PRIMARY KEY CLUSTERED 
(
	[jobseekerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Resumes]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Resumes](
	[resumeID] [int] IDENTITY(1,1) NOT NULL,
	[jobseekerID] [int] NOT NULL,
	[headline] [varchar](max) NULL,
	[description] [varchar](max) NULL,
	[skills] [varchar](max) NULL,
	[experiences] [varchar](max) NULL,
	[education] [varchar](max) NULL,
	[resumeFile] [varchar](max) NULL,
	[lastUpdated] [datetime] NOT NULL,
	[resumeFlag] [binary](1) NOT NULL,
 CONSTRAINT [PK_resumeID@Resumes] PRIMARY KEY CLUSTERED 
(
	[resumeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[UserAccounts]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserAccounts](
	[userID] [int] IDENTITY(1,1) NOT NULL,
	[email] [varchar](450) NOT NULL,
	[password] [varchar](max) NOT NULL,
	[userType] [varchar](max) NOT NULL,
 CONSTRAINT [PK_userID@UserAccounts] PRIMARY KEY CLUSTERED 
(
	[userID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Applications] ON 

INSERT [dbo].[Applications] ([applicationID], [jobPostID], [jobseekerID], [headline], [description], [education], [skills], [experiences], [resumeFile], [lastUpdated], [status], [dateApplied], [dateStatus]) VALUES (1, 1, 1, N'Full Stack Developer', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus varius porttitor. Morbi euismod, nulla et ultricies consequat, urna nulla mattis nulla, tincidunt auctor arcu enim vitae ante. Duis sed malesuada metus, ullamcorper consequat tellus. In gravida tortor ac metus laoreet, in ultrices justo gravida. Suspendisse non eros et ligula tempus ornare. Nullam quis sagittis lectus, ut sollicitudin erat. Nam suscipit, velit vestibulum blandit rhoncus, leo mi auctor eros, ac malesuada nulla diam eu odio.', N'Maecenas eget nibh eget felis vulputate porta sed non lacus. Morbi malesuada urna quis dolor feugiat tincidunt. Sed fringilla tempus nisi, vitae condimentum justo scelerisque in. Vestibulum id tortor in neque viverra aliquam. Mauris pharetra et est sed pellentesque. Cras posuere vulputate lobortis. In hac habitasse platea dictumst. Aliquam aliquet posuere ante et porta. Suspendisse tempor ut lorem et euismod. Aenean sit amet metus ornare, consectetur arcu vel, tincidunt dolor.', N'Etiam luctus a leo non commodo. Donec hendrerit, mi ac condimentum egestas, sapien velit condimentum lacus, eu vehicula est libero quis tortor. In accumsan ornare dictum. Pellentesque porttitor suscipit interdum. Nam non velit consequat tellus bibendum sollicitudin. Etiam pellentesque pulvinar nunc id ultricies.', N'Aliquam ut pharetra sapien. Quisque ut iaculis augue, et commodo enim. Phasellus sed congue augue, vel interdum ipsum. Nunc nunc eros, iaculis in rhoncus eget, tristique vel lacus.', NULL, N'Feb 23 2021 10:34AM', N'Hired', CAST(N'2021-02-23T10:56:24.960' AS DateTime), CAST(N'2021-02-23T11:07:30.320' AS DateTime))
INSERT [dbo].[Applications] ([applicationID], [jobPostID], [jobseekerID], [headline], [description], [education], [skills], [experiences], [resumeFile], [lastUpdated], [status], [dateApplied], [dateStatus]) VALUES (2, 4, 1, N'Full Stack Developer', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus varius porttitor. Morbi euismod, nulla et ultricies consequat, urna nulla mattis nulla, tincidunt auctor arcu enim vitae ante. Duis sed malesuada metus, ullamcorper consequat tellus. In gravida tortor ac metus laoreet, in ultrices justo gravida. Suspendisse non eros et ligula tempus ornare. Nullam quis sagittis lectus, ut sollicitudin erat. Nam suscipit, velit vestibulum blandit rhoncus, leo mi auctor eros, ac malesuada nulla diam eu odio.', N'Maecenas eget nibh eget felis vulputate porta sed non lacus. Morbi malesuada urna quis dolor feugiat tincidunt. Sed fringilla tempus nisi, vitae condimentum justo scelerisque in. Vestibulum id tortor in neque viverra aliquam. Mauris pharetra et est sed pellentesque. Cras posuere vulputate lobortis. In hac habitasse platea dictumst. Aliquam aliquet posuere ante et porta. Suspendisse tempor ut lorem et euismod. Aenean sit amet metus ornare, consectetur arcu vel, tincidunt dolor.', N'Etiam luctus a leo non commodo. Donec hendrerit, mi ac condimentum egestas, sapien velit condimentum lacus, eu vehicula est libero quis tortor. In accumsan ornare dictum. Pellentesque porttitor suscipit interdum. Nam non velit consequat tellus bibendum sollicitudin. Etiam pellentesque pulvinar nunc id ultricies.', N'Aliquam ut pharetra sapien. Quisque ut iaculis augue, et commodo enim. Phasellus sed congue augue, vel interdum ipsum. Nunc nunc eros, iaculis in rhoncus eget, tristique vel lacus.', NULL, N'Feb 23 2021 10:34AM', N'Pending', CAST(N'2021-02-23T11:02:36.280' AS DateTime), NULL)
INSERT [dbo].[Applications] ([applicationID], [jobPostID], [jobseekerID], [headline], [description], [education], [skills], [experiences], [resumeFile], [lastUpdated], [status], [dateApplied], [dateStatus]) VALUES (3, 2, 1, N'Full Stack Developer', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus varius porttitor. Morbi euismod, nulla et ultricies consequat, urna nulla mattis nulla, tincidunt auctor arcu enim vitae ante. Duis sed malesuada metus, ullamcorper consequat tellus. In gravida tortor ac metus laoreet, in ultrices justo gravida. Suspendisse non eros et ligula tempus ornare. Nullam quis sagittis lectus, ut sollicitudin erat. Nam suscipit, velit vestibulum blandit rhoncus, leo mi auctor eros, ac malesuada nulla diam eu odio.', N'Maecenas eget nibh eget felis vulputate porta sed non lacus. Morbi malesuada urna quis dolor feugiat tincidunt. Sed fringilla tempus nisi, vitae condimentum justo scelerisque in. Vestibulum id tortor in neque viverra aliquam. Mauris pharetra et est sed pellentesque. Cras posuere vulputate lobortis. In hac habitasse platea dictumst. Aliquam aliquet posuere ante et porta. Suspendisse tempor ut lorem et euismod. Aenean sit amet metus ornare, consectetur arcu vel, tincidunt dolor.', N'Etiam luctus a leo non commodo. Donec hendrerit, mi ac condimentum egestas, sapien velit condimentum lacus, eu vehicula est libero quis tortor. In accumsan ornare dictum. Pellentesque porttitor suscipit interdum. Nam non velit consequat tellus bibendum sollicitudin. Etiam pellentesque pulvinar nunc id ultricies.', N'Aliquam ut pharetra sapien. Quisque ut iaculis augue, et commodo enim. Phasellus sed congue augue, vel interdum ipsum. Nunc nunc eros, iaculis in rhoncus eget, tristique vel lacus.', NULL, N'Feb 23 2021 10:34AM', N'Hired', CAST(N'2021-02-23T11:02:41.587' AS DateTime), CAST(N'2021-02-23T12:08:07.213' AS DateTime))
INSERT [dbo].[Applications] ([applicationID], [jobPostID], [jobseekerID], [headline], [description], [education], [skills], [experiences], [resumeFile], [lastUpdated], [status], [dateApplied], [dateStatus]) VALUES (4, 5, 1, N'Full Stack Developer', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus varius porttitor. Morbi euismod, nulla et ultricies consequat, urna nulla mattis nulla, tincidunt auctor arcu enim vitae ante. Duis sed malesuada metus, ullamcorper consequat tellus. In gravida tortor ac metus laoreet, in ultrices justo gravida. Suspendisse non eros et ligula tempus ornare. Nullam quis sagittis lectus, ut sollicitudin erat. Nam suscipit, velit vestibulum blandit rhoncus, leo mi auctor eros, ac malesuada nulla diam eu odio.', N'Maecenas eget nibh eget felis vulputate porta sed non lacus. Morbi malesuada urna quis dolor feugiat tincidunt. Sed fringilla tempus nisi, vitae condimentum justo scelerisque in. Vestibulum id tortor in neque viverra aliquam. Mauris pharetra et est sed pellentesque. Cras posuere vulputate lobortis. In hac habitasse platea dictumst. Aliquam aliquet posuere ante et porta. Suspendisse tempor ut lorem et euismod. Aenean sit amet metus ornare, consectetur arcu vel, tincidunt dolor.', N'Etiam luctus a leo non commodo. Donec hendrerit, mi ac condimentum egestas, sapien velit condimentum lacus, eu vehicula est libero quis tortor. In accumsan ornare dictum. Pellentesque porttitor suscipit interdum. Nam non velit consequat tellus bibendum sollicitudin. Etiam pellentesque pulvinar nunc id ultricies.', N'Aliquam ut pharetra sapien. Quisque ut iaculis augue, et commodo enim. Phasellus sed congue augue, vel interdum ipsum. Nunc nunc eros, iaculis in rhoncus eget, tristique vel lacus.', NULL, N'Feb 23 2021 10:34AM', N'Pending', CAST(N'2021-02-23T11:25:05.947' AS DateTime), NULL)
INSERT [dbo].[Applications] ([applicationID], [jobPostID], [jobseekerID], [headline], [description], [education], [skills], [experiences], [resumeFile], [lastUpdated], [status], [dateApplied], [dateStatus]) VALUES (5, 10, 1, N'Full Stack Developer', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus varius porttitor. Morbi euismod, nulla et ultricies consequat, urna nulla mattis nulla, tincidunt auctor arcu enim vitae ante. Duis sed malesuada metus, ullamcorper consequat tellus. In gravida tortor ac metus laoreet, in ultrices justo gravida. Suspendisse non eros et ligula tempus ornare. Nullam quis sagittis lectus, ut sollicitudin erat. Nam suscipit, velit vestibulum blandit rhoncus, leo mi auctor eros, ac malesuada nulla diam eu odio.', N'Maecenas eget nibh eget felis vulputate porta sed non lacus. Morbi malesuada urna quis dolor feugiat tincidunt. Sed fringilla tempus nisi, vitae condimentum justo scelerisque in. Vestibulum id tortor in neque viverra aliquam. Mauris pharetra et est sed pellentesque. Cras posuere vulputate lobortis. In hac habitasse platea dictumst. Aliquam aliquet posuere ante et porta. Suspendisse tempor ut lorem et euismod. Aenean sit amet metus ornare, consectetur arcu vel, tincidunt dolor.', N'Etiam luctus a leo non commodo. Donec hendrerit, mi ac condimentum egestas, sapien velit condimentum lacus, eu vehicula est libero quis tortor. In accumsan ornare dictum. Pellentesque porttitor suscipit interdum. Nam non velit consequat tellus bibendum sollicitudin. Etiam pellentesque pulvinar nunc id ultricies.', N'Aliquam ut pharetra sapien. Quisque ut iaculis augue, et commodo enim. Phasellus sed congue augue, vel interdum ipsum. Nunc nunc eros, iaculis in rhoncus eget, tristique vel lacus.', NULL, N'Feb 23 2021 10:34AM', N'Pending', CAST(N'2021-02-23T11:52:50.150' AS DateTime), NULL)
INSERT [dbo].[Applications] ([applicationID], [jobPostID], [jobseekerID], [headline], [description], [education], [skills], [experiences], [resumeFile], [lastUpdated], [status], [dateApplied], [dateStatus]) VALUES (6, 15, 1, N'Full Stack Developer', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus varius porttitor. Morbi euismod, nulla et ultricies consequat, urna nulla mattis nulla, tincidunt auctor arcu enim vitae ante. Duis sed malesuada metus, ullamcorper consequat tellus. In gravida tortor ac metus laoreet, in ultrices justo gravida. Suspendisse non eros et ligula tempus ornare. Nullam quis sagittis lectus, ut sollicitudin erat. Nam suscipit, velit vestibulum blandit rhoncus, leo mi auctor eros, ac malesuada nulla diam eu odio.', N'Maecenas eget nibh eget felis vulputate porta sed non lacus. Morbi malesuada urna quis dolor feugiat tincidunt. Sed fringilla tempus nisi, vitae condimentum justo scelerisque in. Vestibulum id tortor in neque viverra aliquam. Mauris pharetra et est sed pellentesque. Cras posuere vulputate lobortis. In hac habitasse platea dictumst. Aliquam aliquet posuere ante et porta. Suspendisse tempor ut lorem et euismod. Aenean sit amet metus ornare, consectetur arcu vel, tincidunt dolor.', N'Etiam luctus a leo non commodo. Donec hendrerit, mi ac condimentum egestas, sapien velit condimentum lacus, eu vehicula est libero quis tortor. In accumsan ornare dictum. Pellentesque porttitor suscipit interdum. Nam non velit consequat tellus bibendum sollicitudin. Etiam pellentesque pulvinar nunc id ultricies.', N'Aliquam ut pharetra sapien. Quisque ut iaculis augue, et commodo enim. Phasellus sed congue augue, vel interdum ipsum. Nunc nunc eros, iaculis in rhoncus eget, tristique vel lacus.', NULL, N'Feb 23 2021 10:34AM', N'Hired', CAST(N'2021-02-23T11:57:23.943' AS DateTime), CAST(N'2021-02-23T11:58:11.143' AS DateTime))
SET IDENTITY_INSERT [dbo].[Applications] OFF
GO
SET IDENTITY_INSERT [dbo].[Bookmarks] ON 

INSERT [dbo].[Bookmarks] ([bookmarkID], [jobseekerID], [jobPostID], [dateBookmarked]) VALUES (2, 1, 1, CAST(N'2021-02-23T10:56:16.943' AS DateTime))
INSERT [dbo].[Bookmarks] ([bookmarkID], [jobseekerID], [jobPostID], [dateBookmarked]) VALUES (3, 1, 2, CAST(N'2021-02-23T11:02:49.420' AS DateTime))
INSERT [dbo].[Bookmarks] ([bookmarkID], [jobseekerID], [jobPostID], [dateBookmarked]) VALUES (4, 1, 5, CAST(N'2021-02-23T11:19:31.833' AS DateTime))
INSERT [dbo].[Bookmarks] ([bookmarkID], [jobseekerID], [jobPostID], [dateBookmarked]) VALUES (5, 1, 10, CAST(N'2021-02-23T11:52:52.460' AS DateTime))
INSERT [dbo].[Bookmarks] ([bookmarkID], [jobseekerID], [jobPostID], [dateBookmarked]) VALUES (6, 1, 13, CAST(N'2021-02-23T12:16:10.540' AS DateTime))
INSERT [dbo].[Bookmarks] ([bookmarkID], [jobseekerID], [jobPostID], [dateBookmarked]) VALUES (7, 1, 11, CAST(N'2021-02-23T12:16:11.353' AS DateTime))
SET IDENTITY_INSERT [dbo].[Bookmarks] OFF
GO
SET IDENTITY_INSERT [dbo].[Employers] ON 

INSERT [dbo].[Employers] ([employerID], [companyName], [street], [brgyDistrict], [cityProvince], [contactNumber], [email], [website], [description], [profilePic]) VALUES (1, N'Accenture Philippines', N'11th Ave.', N'Bonifacio Global City', N'Manila', N'09123456789', N'accentureph@email.com', N'https://www.accenture.com/', N'Etiam a pulvinar sapien. Phasellus sed blandit turpis. Proin vitae ex vitae mi viverra dictum a sed enim. Duis lectus massa, commodo sit amet condimentum ac, vestibulum a mi. Vestibulum egestas lorem cursus, pellentesque ex non, tincidunt dolor. Praesent vitae rhoncus mi, in bibendum felis. Vestibulum feugiat quam nibh, ac sodales odio fringilla molestie. Phasellus quis augue in metus rutrum ullamcorper. Integer iaculis felis orci, eu malesuada mauris sodales eget. Nulla odio enim, commodo vel enim non, cursus feugiat nisl. Fusce nec velit semper, tempor urna quis, congue ipsum. Nam condimentum tortor quis pulvinar molestie. Cras sed mi magna. Suspendisse potenti. Nam pellentesque nulla luctus hendrerit feugiat.', N'EMPL_1614048339.png')
INSERT [dbo].[Employers] ([employerID], [companyName], [street], [brgyDistrict], [cityProvince], [contactNumber], [email], [website], [description], [profilePic]) VALUES (2, N'Puma Inc. PH', N'Ayala Avenue', N'Makati', N'Metro Manila', N'+63 2 5532288', N'pumaincph@email.com', N'https://about.puma.com/en/storelocator/philippines/undefined/makati_city-ayala_glorietta_4_mall', N'Non nisi est sit amet facilisis magna etiam tempor orci. Rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar. Dignissim cras tincidunt lobortis feugiat vivamus at augue. Sit amet nisl suscipit adipiscing bibendum. Sit amet mauris commodo quis imperdiet massa tincidunt. Velit scelerisque in dictum non consectetur a erat. Ac tincidunt vitae semper quis lectus nulla at. Mattis molestie a iaculis at erat pellentesque adipiscing commodo. Tincidunt arcu non sodales neque sodales ut etiam sit amet. Sit amet porttitor eget dolor morbi non arcu risus quis. Ultrices gravida dictum fusce ut placerat orci.', N'EMPL_1614049827.png')
INSERT [dbo].[Employers] ([employerID], [companyName], [street], [brgyDistrict], [cityProvince], [contactNumber], [email], [website], [description], [profilePic]) VALUES (3, N'Manulife Financial Corp.', N'Sen. G. Puyat Street', N'Bel Air', N'Makati City', N'+632 8884 7000', N'manulifeph@email.com', N'https://www.manulife.com.ph/', N'Tellus integer feugiat scelerisque varius morbi enim nunc faucibus a. Ac turpis egestas maecenas pharetra convallis posuere morbi leo. Blandit turpis cursus in hac habitasse. Egestas purus viverra accumsan in. Risus viverra adipiscing at in tellus integer. Sagittis id consectetur purus ut faucibus pulvinar elementum. Ullamcorper a lacus vestibulum sed arcu non odio. Quis viverra nibh cras pulvinar mattis. Fringilla est ullamcorper eget nulla facilisi etiam dignissim. Duis tristique sollicitudin nibh sit amet. Netus et malesuada fames ac turpis egestas integer. Nulla at volutpat diam ut venenatis tellus. Amet porttitor eget dolor morbi non arcu risus quis. Aliquet porttitor lacus luctus accumsan. Cursus in hac habitasse platea dictumst. Nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Nec feugiat nisl pretium fusce id.', N'EMPL_1614051359.png')
INSERT [dbo].[Employers] ([employerID], [companyName], [street], [brgyDistrict], [cityProvince], [contactNumber], [email], [website], [description], [profilePic]) VALUES (4, N'San Miguel Corporation', N'San Miguel Avenue', N'Mandaluyong City', N'Metro Manila', N'(+632) 8-632-2000', N'sanmiguel@email.com', N'https://www.sanmiguel.com.ph/', N'Curabitur gravida arcu ac tortor dignissim convallis aenean. Enim blandit volutpat maecenas volutpat blandit. Ultrices neque ornare aenean euismod elementum nisi quis eleifend quam. Cras semper auctor neque vitae tempus quam pellentesque nec. Orci eu lobortis elementum nibh tellus molestie nunc. Eu turpis egestas pretium aenean pharetra. Elementum integer enim neque volutpat ac tincidunt. Tincidunt arcu non sodales neque sodales. Condimentum mattis pellentesque id nibh. Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Egestas sed sed risus pretium quam. Ultricies leo integer malesuada nunc vel risus commodo. Nunc pulvinar sapien et ligula ullamcorper malesuada. Eu tincidunt tortor aliquam nulla facilisi.Curabitur gravida arcu ac tortor dignissim convallis aenean. Enim blandit volutpat maecenas volutpat blandit. Ultrices neque ornare aenean euismod elementum nisi quis eleifend quam. Cras semper auctor neque vitae tempus quam pellentesque nec. Orci eu lobortis elementum nibh tellus molestie nunc. Eu turpis egestas pretium aenean pharetra. Elementum integer enim neque volutpat ac tincidunt. Tincidunt arcu non sodales neque sodales. Condimentum mattis pellentesque id nibh. Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Egestas sed sed risus pretium quam. Ultricies leo integer malesuada nunc vel risus commodo. Nunc pulvinar sapien et ligula ullamcorper malesuada. Eu tincidunt tortor aliquam nulla facilisi.', N'EMPL_1614052338.png')
SET IDENTITY_INSERT [dbo].[Employers] OFF
GO
SET IDENTITY_INSERT [dbo].[JBSK_StatusNotifications] ON 

INSERT [dbo].[JBSK_StatusNotifications] ([notificationID], [applicationID], [readFlag]) VALUES (2, 1, 0x01)
INSERT [dbo].[JBSK_StatusNotifications] ([notificationID], [applicationID], [readFlag]) VALUES (3, 6, 0x01)
INSERT [dbo].[JBSK_StatusNotifications] ([notificationID], [applicationID], [readFlag]) VALUES (4, 3, 0x01)
SET IDENTITY_INSERT [dbo].[JBSK_StatusNotifications] OFF
GO
SET IDENTITY_INSERT [dbo].[JobPosts] ON 

INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (1, 1, N'Web Developer', N'Full Time', N'Information Technology', N'Ullamcorper a lacus vestibulum sed arcu non odio euismod. Egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam. Donec pretium vulputate sapien nec sagittis aliquam malesuada bibendum. Sollicitudin ac orci phasellus egestas. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus. Elit pellentesque habitant morbi tristique senectus et netus et malesuada. ', N'Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit amet. Consequat nisl vel pretium lectus quam id leo in vitae. Et tortor consequat id porta nibh. Risus at ultrices mi tempus imperdiet nulla malesuada. Enim nulla aliquet porttitor lacus luctus accumsan tortor posuere ac. Egestas dui id ornare arcu odio ut sem. Justo donec enim diam vulputate ut. Augue eget arcu dictum varius. Sit amet risus nullam eget felis eget nunc. Netus et malesuada fames ac turpis egestas. Ornare suspendisse sed nisi lacus sed. Tellus molestie nunc non blandit massa enim nec dui. Et leo duis ut diam quam nulla porttitor massa id.', N'Ornare lectus sit amet est placerat in. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. Scelerisque in dictum non consectetur a erat. Sed blandit libero volutpat sed cras ornare arcu dui. Ultrices dui sapien eget mi proin sed libero. Lacinia quis vel eros donec ac odio tempor orci dapibus. Hendrerit dolor magna eget est lorem ipsum dolor sit. Faucibus scelerisque eleifend donec pretium vulputate. ', N'Sed risus ultricies tristique nulla aliquet enim tortor at. Vulputate dignissim suspendisse in est ante in nibh mauris. Massa eget egestas purus viverra accumsan in nisl nisi scelerisque. Blandit volutpat maecenas volutpat blandit aliquam.', N'Et tortor consequat id porta nibh. Nisl nunc mi ipsum faucibus vitae aliquet nec. Faucibus purus in massa tempor nec feugiat nisl pretium. Ornare massa eget egestas purus viverra.', 18000.0000, 26500.0000, CAST(N'2021-02-23T10:51:16.843' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (2, 1, N'Web Designer', N'Full Time', N'Information Technology', N'Commodo nulla facilisi nullam vehicula. Ac auctor augue mauris augue neque. Non blandit massa enim nec dui nunc mattis enim. Massa tempor nec feugiat nisl. Bibendum est ultricies integer quis auctor. Eu lobortis elementum nibh tellus molestie nunc non. Magna etiam tempor orci eu lobortis elementum nibh tellus molestie. Ac orci phasellus egestas tellus rutrum tellus. In aliquam sem fringilla ut morbi tincidunt. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor.', N'Ornare lectus sit amet est placerat in. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. Scelerisque in dictum non consectetur a erat. Sed blandit libero volutpat sed cras ornare arcu dui. Ultrices dui sapien eget mi proin sed libero. Lacinia quis vel eros donec ac odio tempor orci dapibus. Hendrerit dolor magna eget est lorem ipsum dolor sit. Faucibus scelerisque eleifend donec pretium vulputate.', N'Sit amet purus gravida quis. Pharetra massa massa ultricies mi quis hendrerit dolor magna eget. Lacus sed turpis tincidunt id aliquet risus feugiat in ante. Urna id volutpat lacus laoreet non curabitur. Aliquam etiam erat velit scelerisque in.', N'Sed risus ultricies tristique nulla aliquet enim tortor at. Vulputate dignissim suspendisse in est ante in nibh mauris. Massa eget egestas purus viverra accumsan in nisl nisi scelerisque. Blandit volutpat maecenas volutpat blandit aliquam.', N'Ac auctor augue mauris augue neque. Non blandit massa enim nec dui nunc mattis enim. Massa tempor nec feugiat nisl. Bibendum est ultricies integer quis auctor. Eu lobortis elementum nibh tellus molestie nunc non. ', 21600.0000, 28900.0000, CAST(N'2021-02-23T10:57:36.110' AS DateTime), CAST(N'2021-02-23T11:03:09.220' AS DateTime), 0x00)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (3, 1, N'PHP Developer', N'Intern/OJT', N'Information Technology', N'Scelerisque fermentum dui faucibus in ornare quam viverra orci sagittis. Est ultricies integer quis auctor elit. Amet consectetur adipiscing elit pellentesque. Senectus et netus et malesuada. Lobortis feugiat vivamus at augue eget. Etiam sit amet nisl purus in mollis nunc sed. Tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero. Turpis egestas maecenas pharetra convallis. Faucibus scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam. In tellus integer feugiat scelerisque varius morbi enim.', N'Arcu cursus euismod quis viverra nibh cras pulvinar mattis. Enim eu turpis egestas pretium aenean pharetra magna ac placerat. In iaculis nunc sed augue. Lacus vestibulum sed arcu non odio euismod lacinia at. Egestas purus viverra accumsan in nisl nisi. Urna et pharetra pharetra massa. Integer quis auctor elit sed vulputate mi sit amet mauris. Quis viverra nibh cras pulvinar mattis nunc. Praesent tristique magna sit amet purus gravida.', N'Auctor neque vitae tempus quam pellentesque nec. Risus viverra adipiscing at in tellus integer feugiat scelerisque. Pellentesque eu tincidunt tortor aliquam nulla facilisi cras fermentum. ', N'Tortor id aliquet lectus proin nibh nisl condimentum id venenatis. Risus nullam eget felis eget nunc lobortis mattis. Lobortis mattis aliquam faucibus purus in massa. In hendrerit gravida rutrum quisque non tellus.', N'Sed viverra tellus in hac habitasse. In nulla posuere sollicitudin aliquam ultrices sagittis orci. Curabitur vitae nunc sed velit dignissim sodales ut. Iaculis eu non diam phasellus vestibulum lorem sed risus. Mi tempus imperdiet nulla malesuada. Quis blandit turpis cursus in hac habitasse platea dictumst. Elit duis tristique sollicitudin nibh sit amet commodo.', 35600.0000, 58700.0000, CAST(N'2021-02-23T10:59:20.140' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (4, 1, N'Python Developer', N'Part Time', N'Information Technology', N'A diam sollicitudin tempor id. Placerat vestibulum lectus mauris ultrices. Amet dictum sit amet justo donec. Laoreet suspendisse interdum consectetur libero id. Pharetra et ultrices neque ornare. Nisi est sit amet facilisis magna etiam tempor orci eu. In aliquam sem fringilla ut morbi tincidunt. Vel fringilla est ullamcorper eget nulla. Sed turpis tincidunt id aliquet risus feugiat in. Aliquet risus feugiat in ante metus dictum at tempor commodo. Dui sapien eget mi proin sed libero enim sed. Nisl rhoncus mattis rhoncus urna neque viverra. Mi bibendum neque egestas congue.', N'Non nisi est sit amet facilisis magna etiam tempor orci. Rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar. Dignissim cras tincidunt lobortis feugiat vivamus at augue. Sit amet nisl suscipit adipiscing bibendum. ', N'Sit amet mauris commodo quis imperdiet massa tincidunt. Velit scelerisque in dictum non consectetur a erat. Ac tincidunt vitae semper quis lectus nulla at. Mattis molestie a iaculis at erat pellentesque adipiscing commodo. Tincidunt arcu non sodales neque sodales ut etiam sit amet. Sit amet porttitor eget dolor morbi non arcu risus quis. Ultrices gravida dictum fusce ut placerat orci.', N'Elementum sagittis vitae et leo duis ut diam. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Vitae justo eget magna fermentum iaculis eu non. Ultricies mi quis hendrerit dolor magna eget est lorem. Maecenas pharetra convallis posuere morbi leo urna molestie at elementum.', N'Dignissim sodales ut eu sem integer. Mattis vulputate enim nulla aliquet porttitor lacus luctus. Id venenatis a condimentum vitae sapien pellentesque habitant morbi.', 18800.0000, 39300.0000, CAST(N'2021-02-23T11:01:32.223' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (5, 2, N'Product Designer', N'Full Time', N'Manufacturing', N'Nibh venenatis cras sed felis eget. Quis commodo odio aenean sed adipiscing diam donec adipiscing tristique. Justo nec ultrices dui sapien eget mi proin. Augue lacus viverra vitae congue eu consequat ac. Turpis nunc eget lorem dolor sed viverra ipsum nunc. Eget sit amet tellus cras adipiscing enim eu turpis egestas. Id venenatis a condimentum vitae sapien pellentesque. Integer quis auctor elit sed vulputate mi sit amet. A diam sollicitudin tempor id. At urna condimentum mattis pellentesque id nibh. Integer quis auctor elit sed vulputate mi sit amet mauris. Faucibus scelerisque eleifend donec pretium vulputate sapien nec sagittis. Sollicitudin aliquam ultrices sagittis orci a scelerisque purus semper eget. Gravida in fermentum et sollicitudin ac orci phasellus. Nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Proin nibh nisl condimentum id. Ornare arcu dui vivamus arcu felis bibendum ut. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Dolor purus non enim praesent elementum facilisis leo. Mattis pellentesque id nibh tortor id aliquet.', N'Cursus eget nunc scelerisque viverra mauris in aliquam sem fringilla. Felis eget nunc lobortis mattis aliquam faucibus. Quis varius quam quisque id diam vel quam. Morbi non arcu risus quis varius quam. Odio tempor orci dapibus ultrices in iaculis nunc. Vivamus at augue eget arcu dictum. Eros in cursus turpis massa tincidunt dui ut ornare lectus. Sed odio morbi quis commodo odio aenean. Tellus molestie nunc non blandit massa enim. Risus feugiat in ante metus.', N'Non nisi est sit amet facilisis magna etiam tempor orci. Rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar. Dignissim cras tincidunt lobortis feugiat vivamus at augue. Sit amet nisl suscipit adipiscing bibendum. Sit amet mauris commodo quis imperdiet massa tincidunt. Velit scelerisque in dictum non consectetur a erat. ', N'Ac tincidunt vitae semper quis lectus nulla at. Mattis molestie a iaculis at erat pellentesque adipiscing commodo. Tincidunt arcu non sodales neque sodales ut etiam sit amet. Sit amet porttitor eget dolor morbi non arcu risus quis. Ultrices gravida dictum fusce ut placerat orci.', N'A diam sollicitudin tempor id. Placerat vestibulum lectus mauris ultrices. Amet dictum sit amet justo donec. Laoreet suspendisse interdum consectetur libero id. Pharetra et ultrices neque ornare. Nisi est sit amet facilisis magna etiam tempor orci eu. In aliquam sem fringilla ut morbi tincidunt. Vel fringilla est ullamcorper eget nulla. Sed turpis tincidunt id aliquet risus feugiat in.', 23900.0000, 32600.0000, CAST(N'2021-02-23T11:12:08.657' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (6, 2, N'Sales Advisor', N'Part Time', N'Sales and Finance', N'Imperdiet proin fermentum leo vel orci porta non pulvinar. Eget nullam non nisi est sit amet facilisis magna. Viverra orci sagittis eu volutpat odio. Risus nullam eget felis eget nunc lobortis mattis aliquam. Gravida dictum fusce ut placerat orci. Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus. Aliquet enim tortor at auctor urna nunc id cursus metus. Ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Lectus urna duis convallis convallis tellus. Sagittis orci a scelerisque purus. Pulvinar mattis nunc sed blandit. Elementum sagittis vitae et leo duis ut. Turpis massa tincidunt dui ut ornare lectus. Facilisi morbi tempus iaculis urna id. Habitant morbi tristique senectus et netus et malesuada fames ac. Vitae elementum curabitur vitae nunc. Magna eget est lorem ipsum dolor sit amet.', N'Tincidunt praesent semper feugiat nibh. At imperdiet dui accumsan sit amet. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris. Nisl pretium fusce id velit ut tortor pretium viverra. Sollicitudin aliquam ultrices sagittis orci a scelerisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit scelerisque. Ipsum dolor sit amet consectetur adipiscing elit. Tortor vitae purus faucibus ornare suspendisse.', N'Dui sapien eget mi proin sed libero enim sed. Magna fringilla urna porttitor rhoncus dolor purus non enim praesent. Donec ac odio tempor orci dapibus ultrices in. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna. Donec massa sapien faucibus et molestie ac feugiat sed lectus. Sem fringilla ut morbi tincidunt augue interdum. Sed adipiscing diam donec adipiscing tristique.', N'Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Consequat ac felis donec et odio. Diam in arcu cursus euismod.  Malesuada fames ac turpis egestas integer eget aliquet. Nam aliquam sem et tortor consequat id. Viverra tellus in hac habitasse platea dictumst vestibulum. Pretium viverra suspendisse potenti nullam ac. ', N'Purus in massa tempor nec feugiat nisl. Lacinia quis vel eros donec ac odio tempor orci. Aliquam sem et tortor consequat id porta. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Risus viverra adipiscing at in tellus. Ac feugiat sed lectus vestibulum mattis. Ligula ullamcorper malesuada proin libero. Purus semper eget duis at tellus. A erat nam at lectus.

', 23454.0000, 45632.0000, CAST(N'2021-02-23T11:24:20.740' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (7, 2, N'Product Promoter', N'Full Time', N'Sales and Finance', N'Maecenas volutpat blandit aliquam etiam erat velit scelerisque in. Nunc id cursus metus aliquam. Quam nulla porttitor massa id. Sit amet consectetur adipiscing elit ut aliquam purus sit. Curabitur gravida arcu ac tortor dignissim convallis aenean. Enim blandit volutpat maecenas volutpat blandit. Ultrices neque ornare aenean euismod elementum nisi quis eleifend quam. Cras semper auctor neque vitae tempus quam pellentesque nec. Orci eu lobortis elementum nibh tellus molestie nunc. Eu turpis egestas pretium aenean pharetra. Elementum integer enim neque volutpat ac tincidunt. Tincidunt arcu non sodales neque sodales. Condimentum mattis pellentesque id nibh.', N'Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Egestas sed sed risus pretium quam. Ultricies leo integer malesuada nunc vel risus commodo. Nunc pulvinar sapien et ligula ullamcorper malesuada. Eu tincidunt tortor aliquam nulla facilisi.', N'Rhoncus mattis rhoncus urna neque. Metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Ligula ullamcorper malesuada proin libero nunc consequat. Malesuada nunc vel risus commodo viverra. Nulla porttitor massa id neque aliquam vestibulum morbi blandit cursus. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Sed risus ultricies tristique nulla. Nisi est sit amet facilisis magna etiam. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Ut pharetra sit amet aliquam id diam. Vivamus at augue eget arcu dictum varius duis at.', N'Lacus laoreet non curabitur gravida arcu ac. Euismod quis viverra nibh cras pulvinar mattis nunc. Congue eu consequat ac felis donec. Suspendisse potenti nullam ac tortor. Scelerisque eu ultrices vitae auctor eu. Quis ipsum suspendisse ultrices gravida. Metus dictum at tempor commodo ullamcorper. In cursus turpis massa tincidunt dui ut. Accumsan lacus vel facilisis volutpat est. Accumsan in nisl nisi scelerisque eu.', N'Neque ornare aenean euismod elementum nisi. Aliquet porttitor lacus luctus accumsan tortor posuere ac. Tincidunt praesent semper feugiat nibh sed. Sapien pellentesque habitant morbi tristique senectus et netus. Ipsum dolor sit amet consectetur adipiscing elit. Tempor commodo ullamcorper a lacus vestibulum sed. Enim neque volutpat ac tincidunt vitae semper quis lectus. Mauris a diam maecenas sed enim. Laoreet suspendisse interdum consectetur libero id faucibus. ', 15300.0000, 25600.0000, CAST(N'2021-02-23T11:26:57.587' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (8, 3, N'Insurance Business Solutions Marketing Associate', N'Full Time', N'Marketing', N'Eget felis eget nunc lobortis mattis aliquam faucibus purus. Euismod elementum nisi quis eleifend quam adipiscing vitae proin sagittis. Sit amet nisl suscipit adipiscing bibendum est ultricies. Tristique sollicitudin nibh sit amet commodo. Sit amet purus gravida quis blandit turpis. Eu facilisis sed odio morbi quis commodo odio. Ac turpis egestas maecenas pharetra convallis. Amet justo donec enim diam vulputate ut pharetra sit amet. Vitae tortor condimentum lacinia quis vel. Lorem ipsum dolor sit amet consectetur adipiscing elit. Ultricies lacus sed turpis tincidunt.', N'Quis viverra nibh cras pulvinar mattis. Fringilla est ullamcorper eget nulla facilisi etiam dignissim. Duis tristique sollicitudin nibh sit amet. Netus et malesuada fames ac turpis egestas integer. Nulla at volutpat diam ut venenatis tellus. Amet porttitor eget dolor morbi non arcu risus quis. Aliquet porttitor lacus luctus accumsan. Cursus in hac habitasse platea dictumst. Nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Nec feugiat nisl pretium fusce id.', N'Tellus integer feugiat scelerisque varius morbi enim nunc faucibus a. Ac turpis egestas maecenas pharetra convallis posuere morbi leo. Blandit turpis cursus in hac habitasse. Egestas purus viverra accumsan in. Risus viverra adipiscing at in tellus integer. Sagittis id consectetur purus ut faucibus pulvinar elementum. Ullamcorper a lacus vestibulum sed arcu non odio. ', N'Turpis egestas maecenas pharetra convallis posuere. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam. Ultricies lacus sed turpis tincidunt. Nulla facilisi nullam vehicula ipsum a arcu cursus. Congue nisi vitae suscipit tellus mauris. Sit amet venenatis urna cursus. Enim nulla aliquet porttitor lacus luctus accumsan. In arcu cursus euismod quis viverra nibh.', N'Scelerisque eu ultrices vitae auctor eu. Quis ipsum suspendisse ultrices gravida. Metus dictum at tempor commodo ullamcorper. In cursus turpis massa tincidunt dui ut. Accumsan lacus vel facilisis volutpat est. Accumsan in nisl nisi scelerisque eu.', 56900.0000, 87600.0000, CAST(N'2021-02-23T11:38:01.890' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (9, 3, N'Life Insurance Marketing Associate', N'Full Time', N'Marketing Group', N'Rhoncus mattis rhoncus urna neque. Metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Ligula ullamcorper malesuada proin libero nunc consequat. Malesuada nunc vel risus commodo viverra. Nulla porttitor massa id neque aliquam vestibulum morbi blandit cursus. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Sed risus ultricies tristique nulla. Nisi est sit amet facilisis magna etiam. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Ut pharetra sit amet aliquam id diam. Vivamus at augue eget arcu dictum varius duis at.  Eu turpis egestas pretium aenean pharetra. Elementum integer enim neque volutpat ac tincidunt. Tincidunt arcu non sodales neque sodales. Condimentum mattis pellentesque id nibh. Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Egestas sed sed risus pretium quam. Ultricies leo integer malesuada nunc vel risus commodo. Nunc pulvinar sapien et ligula ullamcorper malesuada. Eu tincidunt tortor aliquam nulla facilisi.', N'Maecenas volutpat blandit aliquam etiam erat velit scelerisque in. Nunc id cursus metus aliquam. Quam nulla porttitor massa id. Sit amet consectetur adipiscing elit ut aliquam purus sit. Curabitur gravida arcu ac tortor dignissim convallis aenean. Enim blandit volutpat maecenas volutpat blandit. Ultrices neque ornare aenean euismod elementum nisi quis eleifend quam. Cras semper auctor neque vitae tempus quam pellentesque nec. Orci eu lobortis elementum nibh tellus molestie nunc.', N'Rhoncus mattis rhoncus urna neque. Metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Ligula ullamcorper malesuada proin libero nunc consequat. Malesuada nunc vel risus commodo viverra. Nulla porttitor massa id neque aliquam vestibulum morbi blandit cursus. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Sed risus ultricies tristique nulla. Nisi est sit amet facilisis magna etiam. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Ut pharetra sit amet aliquam id diam. Vivamus at augue eget arcu dictum varius duis at.', N'Neque ornare aenean euismod elementum nisi. Aliquet porttitor lacus luctus accumsan tortor posuere ac. Tincidunt praesent semper feugiat nibh sed. Sapien pellentesque habitant morbi tristique senectus et netus. Ipsum dolor sit amet consectetur adipiscing elit.', N'Tempor commodo ullamcorper a lacus vestibulum sed. Enim neque volutpat ac tincidunt vitae semper quis lectus. Mauris a diam maecenas sed enim. Laoreet suspendisse interdum consectetur libero id faucibus. Turpis egestas maecenas pharetra convallis posuere. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam.', 45900.0000, 68000.0000, CAST(N'2021-02-23T11:39:47.217' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (10, 3, N'Digital Implementation Specialist', N'Full Time', N'Marketing Group', N'Massa vitae tortor condimentum lacinia quis vel. Imperdiet proin fermentum leo vel orci porta non pulvinar. Eget nullam non nisi est sit amet facilisis magna. Viverra orci sagittis eu volutpat odio. Risus nullam eget felis eget nunc lobortis mattis aliquam. Gravida dictum fusce ut placerat orci. Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus. Aliquet enim tortor at auctor urna nunc id cursus metus. Ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Lectus urna duis convallis convallis tellus. Sagittis orci a scelerisque purus. Pulvinar mattis nunc sed blandit. Elementum sagittis vitae et leo duis ut. Turpis massa tincidunt dui ut ornare lectus. Facilisi morbi tempus iaculis urna id. Habitant morbi tristique senectus et netus et malesuada fames ac. Vitae elementum curabitur vitae nunc. Magna eget est lorem ipsum dolor sit amet.', N'Tincidunt praesent semper feugiat nibh. At imperdiet dui accumsan sit amet. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris. Nisl pretium fusce id velit ut tortor pretium viverra. Sollicitudin aliquam ultrices sagittis orci a scelerisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit scelerisque. Ipsum dolor sit amet consectetur adipiscing elit. Tortor vitae purus faucibus ornare suspendisse. Dui sapien eget mi proin sed libero enim sed. Magna fringilla urna porttitor rhoncus dolor purus non enim praesent. Donec ac odio tempor orci dapibus ultrices in. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna. Donec massa sapien faucibus et molestie ac feugiat sed lectus. Sem fringilla ut morbi tincidunt augue interdum. Sed adipiscing diam donec adipiscing tristique.', N'Urna molestie at elementum eu facilisis sed. Lectus magna fringilla urna porttitor. Massa sapien faucibus et molestie. Feugiat vivamus at augue eget arcu dictum varius duis at. Vulputate odio ut enim blandit volutpat maecenas. Praesent semper feugiat nibh sed pulvinar proin gravida.', N'Aliquet enim tortor at auctor urna nunc id. Neque laoreet suspendisse interdum consectetur. Vitae tempus quam pellentesque nec nam aliquam sem. Sit amet mattis vulputate enim nulla. Sem et tortor consequat id porta.', N'Malesuada fames ac turpis egestas integer eget aliquet. Nam aliquam sem et tortor consequat id. Viverra tellus in hac habitasse platea dictumst vestibulum. Pretium viverra suspendisse potenti nullam ac. Purus in massa tempor nec feugiat nisl. Lacinia quis vel eros donec ac odio tempor orci. Aliquam sem et tortor consequat id porta.', 78500.0000, 125000.0000, CAST(N'2021-02-23T11:41:05.993' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (11, 3, N'Investment Writer - Retirement', N'Full Time', N'Marketing Group', N'Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Consequat ac felis donec et odio. Diam in arcu cursus euismod. Urna molestie at elementum eu facilisis sed. Lectus magna fringilla urna porttitor. Massa sapien faucibus et molestie. Feugiat vivamus at augue eget arcu dictum varius duis at. Vulputate odio ut enim blandit volutpat maecenas. Praesent semper feugiat nibh sed pulvinar proin gravida. Aliquet enim tortor at auctor urna nunc id. Neque laoreet suspendisse interdum consectetur. Vitae tempus quam pellentesque nec nam aliquam sem. Sit amet mattis vulputate enim nulla. Sem et tortor consequat id porta.', N'Purus in massa tempor nec feugiat nisl. Lacinia quis vel eros donec ac odio tempor orci. Aliquam sem et tortor consequat id porta. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Risus viverra adipiscing at in tellus. Ac feugiat sed lectus vestibulum mattis. Ligula ullamcorper malesuada proin libero. Purus semper eget duis at tellus. A erat nam at lectus.', N'Maecenas volutpat blandit aliquam etiam erat velit scelerisque in. Nunc id cursus metus aliquam. Quam nulla porttitor massa id. Sit amet consectetur adipiscing elit ut aliquam purus sit. Curabitur gravida arcu ac tortor dignissim convallis aenean. Enim blandit volutpat maecenas volutpat blandit.', N'Ultrices neque ornare aenean euismod elementum nisi quis eleifend quam. Cras semper auctor neque vitae tempus quam pellentesque nec. Orci eu lobortis elementum nibh tellus molestie nunc. Eu turpis egestas pretium aenean pharetra. Elementum integer enim neque volutpat ac tincidunt. Tincidunt arcu non sodales neque sodales.', N'Condimentum mattis pellentesque id nibh. Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Egestas sed sed risus pretium quam. Ultricies leo integer malesuada nunc vel risus commodo. Nunc pulvinar sapien et ligula ullamcorper malesuada. Eu tincidunt tortor aliquam nulla facilisi.', 89600.0000, 100000.0000, CAST(N'2021-02-23T11:42:20.353' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (12, 3, N'Apply General Director, Implementation, Sales & Distribution', N'Full Time', N'Marketing Group', N'Rhoncus mattis rhoncus urna neque. Metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Ligula ullamcorper malesuada proin libero nunc consequat. Malesuada nunc vel risus commodo viverra. Nulla porttitor massa id neque aliquam vestibulum morbi blandit cursus. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Sed risus ultricies tristique nulla. Nisi est sit amet facilisis magna etiam. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Ut pharetra sit amet aliquam id diam. Vivamus at augue eget arcu dictum varius duis at.', N'Lacus laoreet non curabitur gravida arcu ac. Euismod quis viverra nibh cras pulvinar mattis nunc. Congue eu consequat ac felis donec. Suspendisse potenti nullam ac tortor. Scelerisque eu ultrices vitae auctor eu. Quis ipsum suspendisse ultrices gravida. Metus dictum at tempor commodo ullamcorper. In cursus turpis massa tincidunt dui ut. Accumsan lacus vel facilisis volutpat est. Accumsan in nisl nisi scelerisque eu.', N'Eget nullam non nisi est sit amet facilisis magna. Viverra orci sagittis eu volutpat odio. Risus nullam eget felis eget nunc lobortis mattis aliquam. Gravida dictum fusce ut placerat orci. Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus. Aliquet enim tortor at auctor urna nunc id cursus metus. Ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. ', N'Lectus urna duis convallis convallis tellus. Sagittis orci a scelerisque purus. Pulvinar mattis nunc sed blandit. Elementum sagittis vitae et leo duis ut. Turpis massa tincidunt dui ut ornare lectus.', N'Facilisi morbi tempus iaculis urna id. Habitant morbi tristique senectus et netus et malesuada fames ac. Vitae elementum curabitur vitae nunc. Magna eget est lorem ipsum dolor sit amet.', 69500.0000, 98600.0000, CAST(N'2021-02-23T11:43:59.630' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (13, 3, N'Creative Services Associate', N'Full Time', N'Marketing Group', N'Tincidunt praesent semper feugiat nibh. At imperdiet dui accumsan sit amet. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris. Nisl pretium fusce id velit ut tortor pretium viverra. Sollicitudin aliquam ultrices sagittis orci a scelerisque. Volutpat maecenas volutpat blandit aliquam etiam erat velit scelerisque. Ipsum dolor sit amet consectetur adipiscing elit. Malesuada fames ac turpis egestas integer eget aliquet. Nam aliquam sem et tortor consequat id. Viverra tellus in hac habitasse platea dictumst vestibulum. Pretium viverra suspendisse potenti nullam ac. Purus in massa tempor nec feugiat nisl. Lacinia quis vel eros donec ac odio tempor orci. Aliquam sem et tortor consequat id porta. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Risus viverra adipiscing at in tellus. Ac feugiat sed lectus vestibulum mattis. Ligula ullamcorper malesuada proin libero. Purus semper eget duis at tellus. A erat nam at lectus.', N'Tortor vitae purus faucibus ornare suspendisse. Dui sapien eget mi proin sed libero enim sed. Magna fringilla urna porttitor rhoncus dolor purus non enim praesent. Donec ac odio tempor orci dapibus ultrices in. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna. Donec massa sapien faucibus et molestie ac feugiat sed lectus. Sem fringilla ut morbi tincidunt augue interdum. Sed adipiscing diam donec adipiscing tristique.', N'Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras. Consequat ac felis donec et odio. Diam in arcu cursus euismod. Urna molestie at elementum eu facilisis sed. Lectus magna fringilla urna porttitor. Massa sapien faucibus et molestie. Feugiat vivamus at augue eget arcu dictum varius duis at.', N' Vulputate odio ut enim blandit volutpat maecenas. Praesent semper feugiat nibh sed pulvinar proin gravida. Aliquet enim tortor at auctor urna nunc id. Neque laoreet suspendisse interdum consectetur. Vitae tempus quam pellentesque nec nam aliquam sem. Sit amet mattis vulputate enim nulla. Sem et tortor consequat id porta.', N'Maecenas volutpat blandit aliquam etiam erat velit scelerisque in. Nunc id cursus metus aliquam. Quam nulla porttitor massa id. Sit amet consectetur adipiscing elit ut aliquam purus sit.', 54800.0000, 65300.0000, CAST(N'2021-02-23T11:45:46.310' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (14, 4, N'Sales Admin Staff', N'Part Time', N'Finance', N'Curabitur gravida arcu ac tortor dignissim convallis aenean. Enim blandit volutpat maecenas volutpat blandit. Ultrices neque ornare aenean euismod elementum nisi quis eleifend quam. Cras semper auctor neque vitae tempus quam pellentesque nec. Orci eu lobortis elementum nibh tellus molestie nunc. Eu turpis egestas pretium aenean pharetra. Elementum integer enim neque volutpat ac tincidunt. Tincidunt arcu non sodales neque sodales. Condimentum mattis pellentesque id nibh. Sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Egestas sed sed risus pretium quam. Ultricies leo integer malesuada nunc vel risus commodo. Nunc pulvinar sapien et ligula ullamcorper malesuada. Eu tincidunt tortor aliquam nulla facilisi.', N'Rhoncus mattis rhoncus urna neque. Metus vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Ligula ullamcorper malesuada proin libero nunc consequat. Malesuada nunc vel risus commodo viverra. Nulla porttitor massa id neque aliquam vestibulum morbi blandit cursus. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Sed risus ultricies tristique nulla. Nisi est sit amet facilisis magna etiam. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Ut pharetra sit amet aliquam id diam. Vivamus at augue eget arcu dictum varius duis at.', N'Lacus laoreet non curabitur gravida arcu ac. Euismod quis viverra nibh cras pulvinar mattis nunc. Congue eu consequat ac felis donec. Suspendisse potenti nullam ac tortor. Scelerisque eu ultrices vitae auctor eu. Quis ipsum suspendisse ultrices gravida. Metus dictum at tempor commodo ullamcorper. In cursus turpis massa tincidunt dui ut. Accumsan lacus vel facilisis volutpat est. Accumsan in nisl nisi scelerisque eu.', N'Neque ornare aenean euismod elementum nisi. Aliquet porttitor lacus luctus accumsan tortor posuere ac. Tincidunt praesent semper feugiat nibh sed. Sapien pellentesque habitant morbi tristique senectus et netus. Ipsum dolor sit amet consectetur adipiscing elit. Tempor commodo ullamcorper a lacus vestibulum sed. Enim neque volutpat ac tincidunt vitae semper quis lectus. Mauris a diam maecenas sed enim. ', N'Laoreet suspendisse interdum consectetur libero id faucibus. Turpis egestas maecenas pharetra convallis posuere. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam. Ultricies lacus sed turpis tincidunt. Nulla facilisi nullam vehicula ipsum a arcu cursus. Congue nisi vitae suscipit tellus mauris. Sit amet venenatis urna cursus. Enim nulla aliquet porttitor lacus luctus accumsan. In arcu cursus euismod quis viverra nibh.

', 56000.0000, 65000.0000, CAST(N'2021-02-23T11:50:56.607' AS DateTime), NULL, 0x01)
INSERT [dbo].[JobPosts] ([jobPostID], [employerID], [jobTitle], [jobType], [field], [description], [responsibilities], [skills], [experiences], [education], [minSalary], [maxSalary], [dateCreated], [dateModified], [jobPostFlag]) VALUES (15, 4, N'PHP Developer', N'Full Time', N'Information Technology', N'Laoreet suspendisse interdum consectetur libero id faucibus. Turpis egestas maecenas pharetra convallis posuere. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam. Ultricies lacus sed turpis tincidunt. Nulla facilisi nullam vehicula ipsum a arcu cursus. Congue nisi vitae suscipit tellus mauris. Sit amet venenatis urna cursus. Enim nulla aliquet porttitor lacus luctus accumsan. In arcu cursus euismod quis viverra nibh. Neque ornare aenean euismod elementum nisi. Aliquet porttitor lacus luctus accumsan tortor posuere ac. Tincidunt praesent semper feugiat nibh sed. Sapien pellentesque habitant morbi tristique senectus et netus. Ipsum dolor sit amet consectetur adipiscing elit. Tempor commodo ullamcorper a lacus vestibulum sed. Enim neque volutpat ac tincidunt vitae semper quis lectus. Mauris a diam maecenas sed enim.', N'Tellus integer feugiat scelerisque varius morbi enim nunc faucibus a. Ac turpis egestas maecenas pharetra convallis posuere morbi leo. Blandit turpis cursus in hac habitasse. Egestas purus viverra accumsan in. Eget felis eget nunc lobortis mattis aliquam faucibus purus. Euismod elementum nisi quis eleifend quam adipiscing vitae proin sagittis. Sit amet nisl suscipit adipiscing bibendum est ultricies. Tristique sollicitudin nibh sit amet commodo. Sit amet purus gravida quis blandit turpis. Eu facilisis sed odio morbi quis commodo odio. Ac turpis egestas maecenas pharetra convallis. Amet justo donec enim diam vulputate ut pharetra sit amet. Vitae tortor condimentum lacinia quis vel. Lorem ipsum dolor sit amet consectetur adipiscing elit. Ultricies lacus sed turpis tincidunt.', N'Nulla at volutpat diam ut venenatis tellus. Amet porttitor eget dolor morbi non arcu risus quis. Aliquet porttitor lacus luctus accumsan. Cursus in hac habitasse platea dictumst. Nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Nec feugiat nisl pretium fusce id.', N'Enim neque volutpat ac tincidunt vitae semper quis lectus. Mauris a diam maecenas sed enim. Laoreet suspendisse interdum consectetur libero id faucibus. Turpis egestas maecenas pharetra convallis posuere. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam. Ultricies lacus sed turpis tincidunt. Nulla facilisi nullam vehicula ipsum a arcu cursus. Congue nisi vitae suscipit tellus mauris. Sit amet venenatis urna cursus. Enim nulla aliquet porttitor lacus luctus accumsan. In arcu cursus euismod quis viverra nibh.', N'Nisi est sit amet facilisis magna etiam. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Ut pharetra sit amet aliquam id diam. Vivamus at augue eget arcu dictum varius duis at.', 25600.0000, 38900.0000, CAST(N'2021-02-23T11:57:14.157' AS DateTime), NULL, 0x01)
SET IDENTITY_INSERT [dbo].[JobPosts] OFF
GO
SET IDENTITY_INSERT [dbo].[JobSeekers] ON 

INSERT [dbo].[JobSeekers] ([jobseekerID], [firstName], [middleName], [lastName], [birthDate], [gender], [cityProvince], [contactNumber], [email], [profilePic]) VALUES (1, N'Juan', N'Santos', N'Dela Cruz', CAST(N'2000-01-06' AS Date), N'Male', N'Valenzuela City', N'09065645312', N'juandelacruz@email.com', N'JBSK_1614054070.png')
SET IDENTITY_INSERT [dbo].[JobSeekers] OFF
GO
SET IDENTITY_INSERT [dbo].[Resumes] ON 

INSERT [dbo].[Resumes] ([resumeID], [jobseekerID], [headline], [description], [skills], [experiences], [education], [resumeFile], [lastUpdated], [resumeFlag]) VALUES (1, 1, N'Full Stack Developer', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus varius porttitor. Morbi euismod, nulla et ultricies consequat, urna nulla mattis nulla, tincidunt auctor arcu enim vitae ante. Duis sed malesuada metus, ullamcorper consequat tellus. In gravida tortor ac metus laoreet, in ultrices justo gravida. Suspendisse non eros et ligula tempus ornare. Nullam quis sagittis lectus, ut sollicitudin erat. Nam suscipit, velit vestibulum blandit rhoncus, leo mi auctor eros, ac malesuada nulla diam eu odio.', N'Etiam luctus a leo non commodo. Donec hendrerit, mi ac condimentum egestas, sapien velit condimentum lacus, eu vehicula est libero quis tortor. In accumsan ornare dictum. Pellentesque porttitor suscipit interdum. Nam non velit consequat tellus bibendum sollicitudin. Etiam pellentesque pulvinar nunc id ultricies.', N'Aliquam ut pharetra sapien. Quisque ut iaculis augue, et commodo enim. Phasellus sed congue augue, vel interdum ipsum. Nunc nunc eros, iaculis in rhoncus eget, tristique vel lacus.', N'Maecenas eget nibh eget felis vulputate porta sed non lacus. Morbi malesuada urna quis dolor feugiat tincidunt. Sed fringilla tempus nisi, vitae condimentum justo scelerisque in. Vestibulum id tortor in neque viverra aliquam. Mauris pharetra et est sed pellentesque. Cras posuere vulputate lobortis. In hac habitasse platea dictumst. Aliquam aliquet posuere ante et porta. Suspendisse tempor ut lorem et euismod. Aenean sit amet metus ornare, consectetur arcu vel, tincidunt dolor.', NULL, CAST(N'2021-02-23T10:34:11.463' AS DateTime), 0x01)
SET IDENTITY_INSERT [dbo].[Resumes] OFF
GO
SET IDENTITY_INSERT [dbo].[UserAccounts] ON 

INSERT [dbo].[UserAccounts] ([userID], [email], [password], [userType]) VALUES (1, N'juandelacruz@email.com', N'$argon2i$v=19$m=65536,t=4,p=1$aEM5QUJUZFJpY0dEWXd0dg$dwEyRuccrcHcYeP/nYwwHKz7wp6fojCeiEKCJMRWw1U', N'Jobseeker')
INSERT [dbo].[UserAccounts] ([userID], [email], [password], [userType]) VALUES (2, N'accentureph@email.com', N'$argon2i$v=19$m=65536,t=4,p=1$QXZ6YmE3azlSa1FKZTVMcQ$jaJK7CdmdVSRq8JeDXek+dgZTeKurq29CRgUgIdQndU', N'Employer')
INSERT [dbo].[UserAccounts] ([userID], [email], [password], [userType]) VALUES (3, N'pumaincph@email.com', N'$argon2i$v=19$m=65536,t=4,p=1$Skhka1FnNHk2ZkxhUm9HaQ$HOXpRhM7Tuq04YumO467nLsUweUox64xpz89LM3oWQ0', N'Employer')
INSERT [dbo].[UserAccounts] ([userID], [email], [password], [userType]) VALUES (4, N'manulifeph@email.com', N'$argon2i$v=19$m=65536,t=4,p=1$czN0Rld0a2NEQ200dERoRg$kuVLmUGWLQvMGO7hkn0vYh6i2NOnYWEc3C29ikFR8Go', N'Employer')
INSERT [dbo].[UserAccounts] ([userID], [email], [password], [userType]) VALUES (5, N'sanmiguel@email.com', N'$argon2i$v=19$m=65536,t=4,p=1$RERxakhWd2Y3NjFKSnBFYQ$L4JsqUgWeJW8Of1CqG0zBZgEwMOTemyCFD2tCuEYU84', N'Employer')
SET IDENTITY_INSERT [dbo].[UserAccounts] OFF
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ_contactNumber@Employers]    Script Date: 23/02/2021 12:25:52 pm ******/
ALTER TABLE [dbo].[Employers] ADD  CONSTRAINT [UQ_contactNumber@Employers] UNIQUE NONCLUSTERED 
(
	[contactNumber] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ_contactNumber@JobSeekers]    Script Date: 23/02/2021 12:25:52 pm ******/
ALTER TABLE [dbo].[JobSeekers] ADD  CONSTRAINT [UQ_contactNumber@JobSeekers] UNIQUE NONCLUSTERED 
(
	[contactNumber] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [UK_jobseekerID@Resumes]    Script Date: 23/02/2021 12:25:52 pm ******/
ALTER TABLE [dbo].[Resumes] ADD  CONSTRAINT [UK_jobseekerID@Resumes] UNIQUE NONCLUSTERED 
(
	[jobseekerID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ_email@UserAccounts]    Script Date: 23/02/2021 12:25:52 pm ******/
ALTER TABLE [dbo].[UserAccounts] ADD  CONSTRAINT [UQ_email@UserAccounts] UNIQUE NONCLUSTERED 
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Applications] ADD  DEFAULT ('Pending') FOR [status]
GO
ALTER TABLE [dbo].[Applications] ADD  DEFAULT (getdate()) FOR [dateApplied]
GO
ALTER TABLE [dbo].[Bookmarks] ADD  DEFAULT (getdate()) FOR [dateBookmarked]
GO
ALTER TABLE [dbo].[JBSK_StatusNotifications] ADD  DEFAULT ((0)) FOR [readFlag]
GO
ALTER TABLE [dbo].[JobPosts] ADD  DEFAULT (getdate()) FOR [dateCreated]
GO
ALTER TABLE [dbo].[Resumes] ADD  DEFAULT (getdate()) FOR [lastUpdated]
GO
ALTER TABLE [dbo].[Resumes] ADD  DEFAULT ((1)) FOR [resumeFlag]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [FK_jobPostID@Applications] FOREIGN KEY([jobPostID])
REFERENCES [dbo].[JobPosts] ([jobPostID])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [FK_jobPostID@Applications]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Applications] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [FK_jobseekerID@Applications]
GO
ALTER TABLE [dbo].[Bookmarks]  WITH CHECK ADD  CONSTRAINT [FK_jobPostID@Bookmarks] FOREIGN KEY([jobPostID])
REFERENCES [dbo].[JobPosts] ([jobPostID])
GO
ALTER TABLE [dbo].[Bookmarks] CHECK CONSTRAINT [FK_jobPostID@Bookmarks]
GO
ALTER TABLE [dbo].[Bookmarks]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Bookmarks] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Bookmarks] CHECK CONSTRAINT [FK_jobseekerID@Bookmarks]
GO
ALTER TABLE [dbo].[Employers]  WITH CHECK ADD  CONSTRAINT [FK_email@Employers] FOREIGN KEY([email])
REFERENCES [dbo].[UserAccounts] ([email])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Employers] CHECK CONSTRAINT [FK_email@Employers]
GO
ALTER TABLE [dbo].[JBSK_StatusNotifications]  WITH CHECK ADD  CONSTRAINT [FK_aaplicationID@JBSK_StatusNotifications] FOREIGN KEY([applicationID])
REFERENCES [dbo].[Applications] ([applicationID])
GO
ALTER TABLE [dbo].[JBSK_StatusNotifications] CHECK CONSTRAINT [FK_aaplicationID@JBSK_StatusNotifications]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [FK_employerID@JobPosts] FOREIGN KEY([employerID])
REFERENCES [dbo].[Employers] ([employerID])
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [FK_employerID@JobPosts]
GO
ALTER TABLE [dbo].[JobSeekers]  WITH CHECK ADD  CONSTRAINT [FK_email@JobSeekers] FOREIGN KEY([email])
REFERENCES [dbo].[UserAccounts] ([email])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[JobSeekers] CHECK CONSTRAINT [FK_email@JobSeekers]
GO
ALTER TABLE [dbo].[Resumes]  WITH CHECK ADD  CONSTRAINT [FK_jobseekerID@Resumes] FOREIGN KEY([jobseekerID])
REFERENCES [dbo].[JobSeekers] ([jobseekerID])
GO
ALTER TABLE [dbo].[Resumes] CHECK CONSTRAINT [FK_jobseekerID@Resumes]
GO
ALTER TABLE [dbo].[Applications]  WITH CHECK ADD  CONSTRAINT [CK_status@Applications] CHECK  (([status]='Rejected' OR [status]='Interviewing' OR [status]='Hired' OR [status]='Pending'))
GO
ALTER TABLE [dbo].[Applications] CHECK CONSTRAINT [CK_status@Applications]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_jobType@JobPosts] CHECK  (([jobType]='Temporary' OR [jobType]='Intern/OJT' OR [jobType]='Part Time' OR [jobType]='Full Time'))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_jobType@JobPosts]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_maxSalary@JobPosts] CHECK  (([maxSalary]>(0)))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_maxSalary@JobPosts]
GO
ALTER TABLE [dbo].[JobPosts]  WITH CHECK ADD  CONSTRAINT [CK_minSalary@JobPosts] CHECK  (([minSalary]>(0)))
GO
ALTER TABLE [dbo].[JobPosts] CHECK CONSTRAINT [CK_minSalary@JobPosts]
GO
ALTER TABLE [dbo].[JobSeekers]  WITH CHECK ADD  CONSTRAINT [CK_gender@JobSeekers] CHECK  (([gender]='Prefer not to say' OR [gender]='LGBTQA+' OR [gender]='Female' OR [gender]='Male'))
GO
ALTER TABLE [dbo].[JobSeekers] CHECK CONSTRAINT [CK_gender@JobSeekers]
GO
ALTER TABLE [dbo].[UserAccounts]  WITH CHECK ADD  CONSTRAINT [CK_userType@UserAccounts] CHECK  (([userType]='Employer' OR [userType]='Jobseeker'))
GO
ALTER TABLE [dbo].[UserAccounts] CHECK CONSTRAINT [CK_userType@UserAccounts]
GO
/****** Object:  StoredProcedure [dbo].[AUTH_AddUserAccount]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


/**
  * AUTH STORED PROCEDURES
  * 
  * The AUTH Stored Procedures are for authorized users, namely JobSeekers and 
  * Employers that has session
  */

-- Add Job Seeker Account Procedure
CREATE PROCEDURE [dbo].[AUTH_AddUserAccount]
	@email				VARCHAR(450),
	@password			VARCHAR(MAX),
	@userType			VARCHAR(MAX)
AS
	INSERT INTO [UserAccounts] 
		( [email]
		, [password]
		, [userType] )
	VALUES 
		( @email
		, @password
		, @userType )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_CreateJBSKNotification]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Create JBSK Notifications
CREATE PROCEDURE [dbo].[AUTH_CreateJBSKNotification]
	@jobseekerID		INT,
	@title				VARCHAR(MAX),
	@message			VARCHAR(MAX),
	@notificationType	VARCHAR(MAX),
	@link				VARCHAR(MAX)
AS
	INSERT INTO [JBSK_Notifications] 
		( [jobseekerID]
		, [title]
		, [message]
		, [notificationType]
		, [link] )
	VALUES
		( @jobseekerID
		, @title
		, @message
		, @notificationType
		, @link )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindEmployer]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Find Employer Procedure
CREATE PROCEDURE [dbo].[AUTH_FindEmployer]
	@email	VARCHAR(450)
AS
	SELECT * FROM [Employers]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindJobseeker]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Find Job Seeker Procedure
CREATE PROCEDURE [dbo].[AUTH_FindJobseeker]
	@email	VARCHAR(450)
AS
	SELECT *, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
	FROM [JobSeekers]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_FindUserAccount]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Find User Account Procedure for Login
CREATE PROCEDURE [dbo].[AUTH_FindUserAccount]
	@email		VARCHAR(450)
AS
	SELECT
		  [userID]
		, [email]
		, [password]
		, [userType]
	FROM [UserAccounts]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_GetUserPassword]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get User Password
CREATE PROCEDURE [dbo].[AUTH_GetUserPassword]
	@email VARCHAR(450)
AS
	SELECT [password] FROM [UserAccounts]
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_NotifyJBSKStatus]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Notify JobSeeker To Its Application
CREATE PROCEDURE [dbo].[AUTH_NotifyJBSKStatus]
	@applicationID INT
AS
	INSERT INTO [JBSK_StatusNotifications] ([applicationID])
	VALUES (@applicationID)

GO
/****** Object:  StoredProcedure [dbo].[AUTH_RegisterEmployer]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Register Employer Procedure
CREATE PROCEDURE [dbo].[AUTH_RegisterEmployer]
	@companyName	VARCHAR(MAX),
	@street			VARCHAR(MAX),
	@brgyDistrict	VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@email			VARCHAR(450),
	@website		VARCHAR(MAX),
	@description	VARCHAR(MAX)
AS
	INSERT INTO [Employers]
		( [companyName]
		, [street]
		, [brgyDistrict]
		, [cityProvince]
		, [contactNumber]
		, [email]
		, [website]
		, [description] )
	VALUES
		( @companyName
		, @street
		, @brgyDistrict
		, @cityProvince
		, @contactNumber
		, @email
		, @website
		, @description )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_RegisterJobseeker]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Register Job Seeker Procedure
CREATE PROCEDURE [dbo].[AUTH_RegisterJobseeker]
	@firstName		VARCHAR(MAX),
	@middleName		VARCHAR(MAX),
	@lastName		VARCHAR(MAX),
	@birthDate		VARCHAR(MAX),
	@gender			VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@email			VARCHAR(450)
AS
	INSERT INTO [JobSeekers] 
		( [firstName]
		, [middleName]
		, [lastName]
		, [birthDate]
		, [gender]
		, [cityProvince]
		, [contactNumber]
		, [email] )
	VALUES 
		( @firstName
		, @middleName
		, @lastName
		, @birthDate
		, @gender
		, @cityProvince
		, @contactNumber
		, @email )
GO
/****** Object:  StoredProcedure [dbo].[AUTH_RemoveJBSKStatusNotification]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Remove JobSeeker Status Notification
CREATE PROCEDURE [dbo].[AUTH_RemoveJBSKStatusNotification]
	@applicationID INT
AS
	DELETE FROM [JBSK_StatusNotifications]
	WHERE [applicationID] = @applicationID

GO
/****** Object:  StoredProcedure [dbo].[AUTH_UpdateEmail]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Change User Email
CREATE PROCEDURE [dbo].[AUTH_UpdateEmail]
	@email		VARCHAR(450),
	@newEmail	VARCHAR(450)
AS
	UPDATE [UserAccounts]
	SET [email] = @newEmail
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[AUTH_UpdatePassword]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Password
CREATE PROCEDURE [dbo].[AUTH_UpdatePassword]
	@email		VARCHAR(450),
	@password	VARCHAR(MAX)
AS
	UPDATE [UserAccounts]
	SET [password] = @password
	WHERE [email] = @email
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ApplicantsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View All Applicants Procedure
CREATE PROCEDURE [dbo].[EMPL_ApplicantsNum]
	@jobPostID INT,
	@status	   VARCHAR(MAX)
AS
	SELECT COUNT([Applications].[applicationID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [Applications].[status] = @status
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	WHERE [JobPosts].[jobPostID] = @jobPostID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_DeletePost]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Delete Job Post Procedure
CREATE PROCEDURE [dbo].[EMPL_DeletePost]
	@jobPostID	INT,
	@employerID INT
AS
	DELETE FROM [JobPosts] 
	WHERE [jobPostID] = @jobPostID AND [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_GetPosts]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Limited Posts Procedure
CREATE PROCEDURE [dbo].[EMPL_GetPosts] 
	@offsetRows  INT,
	@fetchedRows INT,
	@employerID  INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, COUNT([Applications].[applicationID]) AS [applicantsNum]
	FROM [JobPosts]
	FULL OUTER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO
/****** Object:  StoredProcedure [dbo].[EMPL_PostNewJob]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


/**
  * EMPL STORED PROCEDURES
  * 
  * The EMPL Stored Procedures are exclusive only for employers
  */

-- Post New Job Procedure
CREATE PROCEDURE [dbo].[EMPL_PostNewJob]
	@employerID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@field				VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	INSERT INTO [JobPosts]
		( [employerID]
		, [jobTitle]
		, [jobType]
		, [field]
		, [description]
		, [responsibilities]
		, [skills]
		, [experiences]
		, [education]
		, [minSalary]
		, [maxSalary]
		, [jobPostFlag])
	VALUES
		( @employerID
		, @jobTitle			
		, @jobType			
		, @field		
		, @description	
		, @responsibilities
		, @skills		
		, @experiences	
		, @education	
		, @minSalary		
		, @maxSalary		
		, @jobPostFlag )
GO
/****** Object:  StoredProcedure [dbo].[EMPL_PostsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Number of Posts
CREATE PROCEDURE [dbo].[EMPL_PostsNum] 
	@employerID INT
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [JobPosts]
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_SetApplicantStatus]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Applicant Status Procedure
CREATE PROCEDURE [dbo].[EMPL_SetApplicantStatus]
	@applicationID INT,
	@status		   VARCHAR(MAX)
AS
	IF @status = 'Pending'
		BEGIN
			UPDATE [Applications]
			SET 
				[status]	 = @status,
				[dateStatus] = NULL
			WHERE [applicationID] = @applicationID
		END
	ELSE
		BEGIN
			UPDATE [Applications]
			SET 
				[status]	 = @status,
				[dateStatus] = GETDATE()
			WHERE [applicationID] = @applicationID
		END
GO
/****** Object:  StoredProcedure [dbo].[EMPL_SetProfilePic]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Profile Pic
CREATE PROCEDURE [dbo].[EMPL_SetProfilePic]
	@employerID INT,
	@profilePic	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET [profilePic] = @profilePic
	WHERE [employerID] = @employerID

GO
/****** Object:  StoredProcedure [dbo].[EMPL_UpdateInfo]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Employer Information Procedure
CREATE PROCEDURE [dbo].[EMPL_UpdateInfo]
	@employerID		INT,
	@companyName	VARCHAR(MAX),
	@street			VARCHAR(MAX),
	@brgyDistrict	VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX),
	@website		VARCHAR(MAX),
	@description	VARCHAR(MAX)
AS
	UPDATE [Employers]
	SET
		  [companyName] 	= @companyName
		, [street] 			= @street
		, [brgyDistrict] 	= @brgyDistrict
		, [cityProvince]	= @cityProvince
		, [contactNumber] 	= @contactNumber
		, [website] 		= @website
		, [description] 	= @description
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_UpdatePost]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Job Post Procedure
CREATE PROCEDURE [dbo].[EMPL_UpdatePost]
	@jobPostID			INT,
	@jobTitle			VARCHAR(MAX),
	@jobType			VARCHAR(MAX),
	@field				VARCHAR(MAX),
	@description		VARCHAR(MAX),
	@responsibilities	VARCHAR(MAX),
	@skills				VARCHAR(MAX),
	@experiences		VARCHAR(MAX),
	@education			VARCHAR(MAX),
	@minSalary			MONEY,
	@maxSalary			MONEY,
	@jobPostFlag		BINARY
AS
	UPDATE [JobPosts]
	SET
		  [jobTitle] 			= @jobTitle
		, [jobType] 			= @jobType
		, [field] 				= @field
		, [description] 		= @description
		, [responsibilities] 	= @responsibilities
		, [skills] 				= @skills
		, [experiences] 		= @experiences
		, [education] 			= @education
		, [minSalary] 			= @minSalary
		, [maxSalary] 			= @maxSalary
		, [dateModified] 		= getdate()
		, [jobPostFlag] 		= @jobPostFlag
	WHERE [jobPostID]			= @jobPostID
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewApplicantProfile]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Applicant Profile Procedure
CREATE PROCEDURE [dbo].[EMPL_ViewApplicantProfile]
	@jobseekerID INT,
	@jobPostID   INT
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[birthDate]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[headline]
		, [Applications].[description]
		, [Applications].[education]
		, [Applications].[skills]
		, [Applications].[experiences]
		, [Applications].[lastUpdated]
		, [Applications].[resumeFile]
		, [JobPosts].[jobTitle]
	FROM [Applications]
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	WHERE [Applications].[jobPostID] = @jobPostID

GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewApplicants]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Applicants Procedure
CREATE PROCEDURE [dbo].[EMPL_ViewApplicants]
	@offsetRows  INT,
	@fetchedRows INT,
	@jobPostID   INT,
	@status		 VARCHAR(MAX)
AS
	SELECT
		  [JobSeekers].[jobseekerID]
		, [JobSeekers].[profilePic]
		, [JobSeekers].[firstName]
		, [JobSeekers].[middleName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[lastName]
		, [JobSeekers].[gender]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[jobPostID]
		, [Applications].[status]
		, [Applications].[dateApplied]
	FROM [JobPosts]
	INNER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
		AND [Applications].[status] = @status
	INNER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	WHERE [JobPosts].[jobPostID] = @jobPostID
	ORDER BY [Applications].[dateApplied] ASC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY
GO
/****** Object:  StoredProcedure [dbo].[EMPL_ViewPost]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Job Post
CREATE PROCEDURE [dbo].[EMPL_ViewPost]
	@jobPostID	INT,
	@employerID INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, COUNT([Applications].[applicationID]) AS [applicantsNum]
	FROM [JobPosts]
	LEFT OUTER JOIN [Applications]
		ON [Applications].[jobPostID] = [JobPosts].[jobPostID]
	WHERE [JobPosts].[jobPostID] = @jobPostID 
		AND [JobPosts].[employerID] = @employerID
	GROUP BY
		  [JobPosts].[jobPostID]
		, [JobPosts].[employerID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[responsibilities]
		, [JobPosts].[skills]
		, [JobPosts].[experiences]
		, [JobPosts].[education]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[dateModified]
		, [JobPosts].[jobPostFlag]
GO
/****** Object:  StoredProcedure [dbo].[JBSK_AddBookmark]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Add Bookmark Procedure
CREATE PROCEDURE [dbo].[JBSK_AddBookmark]
	@jobseekerID INT,
	@jobPostID	 INT
AS
	INSERT INTO [Bookmarks]
		( [jobseekerID]
		, [jobPostID] )
	VALUES 
		( @jobseekerID
		, @jobPostID )

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ApplicationStatus]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Job Details 
CREATE PROCEDURE [dbo].[JBSK_ApplicationStatus]
	@jobPostID	 INT,
	@jobseekerID INT
AS
	SELECT
		  [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, [JobSeekers].[gender]
		, DATEDIFF(hour, [birthDate], GETDATE())/8766 AS [age]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
		, [Applications].[applicationID]
		, [Applications].[headline]
		, [Applications].[description]
		, [Applications].[education]
		, [Applications].[skills]
		, [Applications].[experiences]
		, [Applications].[lastUpdated]
		, [Applications].[dateApplied]
		, [Applications].[status] AS [applicationStatus]
		, [Applications].[dateStatus]
		, [Bookmarks].[bookmarkID]
	FROM [JobPosts]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE [JobPosts].[jobPostID] = @jobPostID 

GO
/****** Object:  StoredProcedure [dbo].[JBSK_AppliedJobsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Number of Applied Jobs Procedure
CREATE PROCEDURE [dbo].[JBSK_AppliedJobsNum]
	@jobseekerID INT
AS
	SELECT COUNT([Applications].[JobPostID]) AS [count]
	FROM [Applications]
	INNER JOIN [Resumes]
		ON [Resumes].[jobseekerID] = [Applications].[jobseekerID]
	WHERE [Applications].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_AppliedJobsToStatus]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Applied Jobs Procedure
CREATE PROCEDURE [dbo].[JBSK_AppliedJobsToStatus]
	@offsetRows	 INT,
	@fetchedRows INT,
	@jobseekerID INT,
	@status		 VARCHAR(MAX)
AS
	SELECT
		  [Applications].[applicationID]
		, [Applications].[dateApplied]
		, [Applications].[status]
		, [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		  AS [location]
		, [Bookmarks].[bookmarkID]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status
	ORDER BY [Applications].[dateApplied] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY

GO
/****** Object:  StoredProcedure [dbo].[JBSK_AppliedJobsToStatusNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Number of Applied Jobs Based on Status Procedure
CREATE PROCEDURE [dbo].[JBSK_AppliedJobsToStatusNum]
	@jobseekerID INT,
	@status		 VARCHAR(MAX)
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [Applications]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE 
		[Applications].[jobseekerID] = @jobseekerID
		AND [Applications].[status] = @status

GO
/****** Object:  StoredProcedure [dbo].[JBSK_BookmarksNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Number of Bookmarks
CREATE PROCEDURE [dbo].[JBSK_BookmarksNum]
	@jobseekerID INT
AS
	SELECT COUNT([Bookmarks].[bookmarkID]) AS [count]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE [Bookmarks].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_CancelApplication]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Cancel Application Procedure
CREATE PROCEDURE [dbo].[JBSK_CancelApplication]
	@applicationID INT
AS
	DELETE FROM [Applications]
	WHERE [applicationID] = @applicationID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_CreateResume]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Create Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_CreateResume]
	@jobseekerID	INT,
	@headline		VARCHAR(MAX),
	@description	VARCHAR(MAX),
	@education		VARCHAR(MAX),
	@skills			VARCHAR(MAX),
	@experiences	VARCHAR(MAX),
	@resumeFlag		BINARY
AS
	INSERT INTO [Resumes]
		( [jobseekerID]
		, [headline]
		, [description]
		, [education]
		, [skills]
		, [experiences]
		, [resumeFlag] )
	VALUES
		( @jobseekerID
		, @headline
		, @description
		, @education
		, @skills
		, @experiences
		, @resumeFlag )

GO
/****** Object:  StoredProcedure [dbo].[JBSK_GetBookmarks]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Bookmarks
CREATE PROCEDURE [dbo].[JBSK_GetBookmarks]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [Bookmarks].[bookmarkID]
		, [Bookmarks].[dateBookmarked]
		, [Bookmarks].[jobseekerID]
		, [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, CAST([JobPosts].[jobPostFlag] AS INT) AS [jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Applications].[status]
	FROM [Bookmarks]
	INNER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
	INNER JOIN [Employers]
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE [Bookmarks].[jobseekerID] = @jobseekerID
	ORDER BY [Bookmarks].[dateBookmarked] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROW ONLY

GO
/****** Object:  StoredProcedure [dbo].[JBSK_GetStatusNotifications]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Status Notifcations
CREATE PROCEDURE [dbo].[JBSK_GetStatusNotifications]
	@jobseekerID	INT,
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT
		  [N].[notificationID]
		, [N].[applicationID]
		, CAST([N].[readFlag] AS INT) AS [readFlag]
		, [A].[status]
		, [A].[dateStatus]
		, [P].[jobPostID]
		, [P].[jobTitle]
		, [E].[companyName]
		, [E].[profilePic]
	FROM [JBSK_StatusNotifications] AS [N]
	INNER JOIN [Applications] AS [A]
		ON [N].[applicationID] = [A].[applicationID]
		AND [A].[jobseekerID] = @jobseekerID
	INNER JOIN [JobPosts] AS [P]
		ON [A].[jobPostID] = [P].[jobPostID]
	INNER JOIN [Employers] AS [E]
		ON [P].[employerID] = [E].[employerID]
	ORDER BY [A].[dateStatus] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY

GO
/****** Object:  StoredProcedure [dbo].[JBSK_RecentPostsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View All Recent Posts
CREATE PROCEDURE [dbo].[JBSK_RecentPostsNum]
	@jobseekerID INT
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_RemoveBookmark]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Remove Bookmark Procedure
CREATE PROCEDURE [dbo].[JBSK_RemoveBookmark]
	@bookmarkID INT
AS
	DELETE FROM [Bookmarks] WHERE [bookmarkID] = @bookmarkID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_RemoveResume]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Remove Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_RemoveResume]
	@resumeID INT
AS
	DELETE FROM [Resumes] WHERE [resumeID] = @resumeID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_SearchResultNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Number of Search Result
CREATE PROCEDURE [dbo].[JBSK_SearchResultNum]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@jobseekerID INT
AS
	SELECT COUNT([JobPosts].[jobPostID]) AS [count]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND (
			[Employers].[brgyDistrict] LIKE '%' + @location + '%'
			OR [Employers].[cityProvince] LIKE '%' + @location + '%'
		)

GO
/****** Object:  StoredProcedure [dbo].[JBSK_SetNotificationReadFlag]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Notification Read Flag
CREATE PROCEDURE [dbo].[JBSK_SetNotificationReadFlag]
	@notificationID INT,
	@readFlag		INT
AS
	UPDATE [JBSK_StatusNotifications]
	SET [readFlag] = @readFlag
	WHERE [notificationID] = @notificationID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_SetProfilePic]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Set Profile Pic
CREATE PROCEDURE [dbo].[JBSK_SetProfilePic]
	@jobseekerID INT,
	@profilePic	 VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET [profilePic] = @profilePic
	WHERE [jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_StatusNotificationsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Status Notifications Count
CREATE PROCEDURE [dbo].[JBSK_StatusNotificationsNum]
	@jobseekerID INT
AS
	SELECT COUNT([notificationID]) AS [count]
	FROM [JBSK_StatusNotifications] AS [N]
	INNER JOIN [Applications] AS [A]
		ON [N].[applicationID] = [A].[applicationID]
		AND [A].[jobseekerID] = @jobseekerID
	INNER JOIN [JobPosts] AS [P]
		ON [A].[jobPostID] = [P].[jobPostID]
	INNER JOIN [Employers] AS [E]
		ON [P].[employerID] = [E].[employerID]

GO
/****** Object:  StoredProcedure [dbo].[JBSK_SubmitApplication]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Submit Application Procedure
CREATE PROCEDURE [dbo].[JBSK_SubmitApplication]
	@jobPostID INT,
	@resumeID  INT
AS
	INSERT INTO [Applications]
		( [jobPostID]
		, [jobseekerID]
		, [headline]
		, [description]
		, [education]
		, [skills] 
		, [experiences] 
		, [resumeFile]
		, [lastUpdated] )
	SELECT
		  [JobPosts].[jobPostID]
		, [Resumes].[jobseekerID]
		, [Resumes].[headline]
		, [Resumes].[description]
		, [Resumes].[education]
		, [Resumes].[skills]
		, [Resumes].[experiences]
		, [Resumes].[resumeFile]
		, [Resumes].[lastUpdated]
	FROM [Resumes]
	LEFT OUTER JOIN [JobPosts]
		ON [JobPosts].[jobPostID] = @jobPostID
	WHERE
		[Resumes].[resumeID] = @resumeID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_UnreadStatusNotificationsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Unread Status Notifications Count
CREATE PROCEDURE [dbo].[JBSK_UnreadStatusNotificationsNum]
	@jobseekerID INT
AS
	SELECT COUNT([notificationID]) AS [count]
	FROM [JBSK_StatusNotifications] AS [N]
	INNER JOIN [Applications] AS [A]
		ON [N].[applicationID] = [A].[applicationID]
		AND [A].[jobseekerID] = @jobseekerID
	INNER JOIN [JobPosts] AS [P]
		ON [A].[jobPostID] = [P].[jobPostID]
	INNER JOIN [Employers] AS [E]
		ON [P].[employerID] = [E].[employerID]
	WHERE [N].[readFlag] = 0

GO
/****** Object:  StoredProcedure [dbo].[JBSK_UpdateInfo]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Job Seeker Information Procedure
CREATE PROCEDURE [dbo].[JBSK_UpdateInfo]
	@jobseekerID	INT,
	@firstName		VARCHAR(MAX),
	@middleName		VARCHAR(MAX),
	@lastName		VARCHAR(MAX),
	@birthDate		VARCHAR(MAX),
	@gender			VARCHAR(MAX),
	@cityProvince	VARCHAR(MAX),
	@contactNumber	VARCHAR(MAX)
AS
	UPDATE [JobSeekers]
	SET
		  [firstName] 		= @firstName
		, [middleName] 		= @middleName
		, [lastName] 		= @lastName
		, [birthDate] 		= @birthDate
		, [gender] 			= @gender
		, [cityProvince]	= @cityProvince
		, [contactNumber] 	= @contactNumber
	WHERE [jobseekerID]		= @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_UpdateResume]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Update Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_UpdateResume]
	@resumeID INT,
	@headline		VARCHAR(MAX),
	@description	VARCHAR(MAX),
	@education		VARCHAR(MAX),
	@skills			VARCHAR(MAX),
	@experiences	VARCHAR(MAX),
	@resumeFlag		BINARY
AS
	UPDATE [Resumes]
	SET 
		  [headline]	= @headline
		, [description]	= @description
		, [education]	= @education
		, [skills]		= @skills
		, [experiences] = @experiences
		, [resumeFlag]	= @resumeFlag
	WHERE [resumeID] = @resumeID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewAvailableJobs]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Available Jobs
CREATE PROCEDURE [dbo].[JBSK_ViewAvailableJobs]
	@jobseekerID INT,
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] + ', ' + [Employers].[cityProvince] AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[dateApplied]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [JobSeekers]
		ON [Applications].[jobseekerID] = [JobSeekers].[jobseekerID]
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	WHERE [JobPosts].[employerID] = @employerID
		AND [jobPostFlag] = 1
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewRecentPosts]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Recent Posts
CREATE PROCEDURE [dbo].[JBSK_ViewRecentPosts]
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		  AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewResume]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


/**
  * JBSK STORED PROCEDURES
  * 
  * The JBSK Stored Procedures are exclusive only for jobseekers
  */

-- View Resume Procedure
CREATE PROCEDURE [dbo].[JBSK_ViewResume]
	@jobseekerID INT
AS
	SELECT
		  [Resumes].[resumeID]
		, [Resumes].[jobseekerID]
		, [Resumes].[headline]
		, [Resumes].[description]
		, [Resumes].[education]
		, [Resumes].[experiences]
		, [Resumes].[skills]
		, [Resumes].[lastUpdated]
		, CAST([Resumes].[resumeFlag] AS INT) AS [resumeFlag]
		, [JobSeekers].[firstName] + ' ' + [JobSeekers].[lastName] AS [fullName]
		, CONVERT(INT, ROUND(DATEDIFF(hour, [birthDate], GETDATE())/8766.0,0)) AS [age]
		, [JobSeekers].[gender]
		, [JobSeekers].[cityProvince]
		, [JobSeekers].[contactNumber]
		, [JobSeekers].[email]
	FROM [Resumes]
	INNER JOIN [JobSeekers]
		ON [Resumes].[jobseekerID] = [JobSeekers].[jobseekerID]
		AND [JobSeekers].[jobseekerID] = @jobseekerID

GO
/****** Object:  StoredProcedure [dbo].[JBSK_ViewSearchResult]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Search Result
CREATE PROCEDURE [dbo].[JBSK_ViewSearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@jobseekerID INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT
		  [JobPosts].[jobPostID]
		, [JobPosts].[jobTitle]
		, [JobPosts].[jobType]
		, [JobPosts].[field]
		, [JobPosts].[description]
		, [JobPosts].[minSalary]
		, [JobPosts].[maxSalary]
		, [JobPosts].[dateCreated]
		, [JobPosts].[jobPostFlag]
		, [Employers].[employerID]
		, [Employers].[profilePic]
		, [Employers].[companyName]
		, [Employers].[brgyDistrict] 
			+ ', ' 
			+ [Employers].[cityProvince] 
		  AS [location]
		, [Bookmarks].[bookmarkID]
		, [Applications].[status]
	FROM [JobPosts]
	INNER JOIN [Employers] 
		ON [JobPosts].[employerID] = [Employers].[employerID]
		AND [jobPostFlag] = 1
	LEFT OUTER JOIN [Bookmarks]
		ON [JobPosts].[jobPostID] = [Bookmarks].[jobPostID]
		AND [Bookmarks].[jobseekerID] = @jobseekerID
	LEFT OUTER JOIN [Applications]
		ON [JobPosts].[jobPostID] = [Applications].[jobPostID]
		AND [Applications].[jobseekerID] = @jobseekerID
	WHERE
		[JobPosts].[jobTitle] LIKE '%' + @jobTitle + '%'
		AND (
			[Employers].[brgyDistrict] LIKE '%' + @location + '%'
			OR [Employers].[cityProvince] LIKE '%' + @location + '%'
		)
	ORDER BY [JobPosts].[dateCreated]
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY

GO
/****** Object:  StoredProcedure [dbo].[MAIN_AvailableJobs]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Available Jobs
CREATE PROCEDURE [dbo].[MAIN_AvailableJobs]
	@employerID  INT,
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE [employerID] = @employerID
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO
/****** Object:  StoredProcedure [dbo].[MAIN_AvailableJobsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Get Number of Available Jobs
CREATE PROCEDURE [dbo].[MAIN_AvailableJobsNum]
	@employerID  INT
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[MAIN_CompanyDetails]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Employer Details Procedure
CREATE PROCEDURE [dbo].[MAIN_CompanyDetails]
	@employerID INT
AS
	SELECT
		  [employerID]
		, [profilePic]
		, [companyName]
		, [description]
		, [street] + ', ' + [brgyDistrict] + ', ' + [cityProvince] AS [location]
		, [contactNumber]
		, [email]
		, [website]
	FROM [Employers]
	WHERE [employerID] = @employerID
GO
/****** Object:  StoredProcedure [dbo].[MAIN_GetSearchResult]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--  Get Search Result
CREATE PROCEDURE [dbo].[MAIN_GetSearchResult]
	@jobTitle	 VARCHAR(MAX),
	@location	 VARCHAR(MAX),
	@offsetRows  INT,
	@fetchedRows INT
AS
	SELECT * FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;

GO
/****** Object:  StoredProcedure [dbo].[MAIN_JobDetails]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Job Details Procedure
CREATE PROCEDURE [dbo].[MAIN_JobDetails]
	@jobPostID	INT
AS
	SELECT * FROM [JobDetails]
	WHERE jobPostID = @jobPostID

GO
/****** Object:  StoredProcedure [dbo].[MAIN_RecentPosts]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- View Active Posts
CREATE PROCEDURE [dbo].[MAIN_RecentPosts]
	@offsetRows		INT,
	@fetchedRows	INT
AS
	SELECT * FROM [Posts]
	ORDER BY [dateCreated] DESC
	OFFSET @offsetRows ROWS
	FETCH NEXT @fetchedRows ROWS ONLY;
GO
/****** Object:  StoredProcedure [dbo].[MAIN_RecentPostsNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/* ============================================================================== */
/*                            STORED PROCEDURES                                   */
/* ============================================================================== */

/**
  * MAIN STORED PROCEDURES
  * 
  * The MAIN Stored Procedures are for all users, even no session
  */

-- Get Number of Active Posts
CREATE PROCEDURE [dbo].[MAIN_RecentPostsNum]
AS 
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]

GO
/****** Object:  StoredProcedure [dbo].[MAIN_SearchResultNum]    Script Date: 23/02/2021 12:25:52 pm ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


-- Get Number of Search Result
CREATE PROCEDURE [dbo].[MAIN_SearchResultNum]
	@jobTitle VARCHAR(MAX),
	@location VARCHAR(MAX)
AS
	SELECT COUNT([jobPostID]) AS [count]
	FROM [Posts]
	WHERE
		[jobTitle] LIKE '%' + @jobTitle + '%'
		AND ([brgyDistrict] LIKE '%' + @location + '%'
		OR [cityProvince] LIKE '%' + @location + '%')

GO
USE [master]
GO
ALTER DATABASE [ABN_Job_Portal] SET  READ_WRITE 
GO
